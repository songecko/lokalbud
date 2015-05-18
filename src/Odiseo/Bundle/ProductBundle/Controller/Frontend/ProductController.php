<?php

namespace Odiseo\Bundle\ProductBundle\Controller\Frontend;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Odiseo\Bundle\ProductBundle\Form\Type\ProductFormType;
use Odiseo\Bundle\ProductBundle\Entity\ProductState;

class ProductController extends Controller
{
	public function indexAction(Request $request)
	{	
		$filters = $request->get('filter', array());
		$page = $request->get('page', 1);
		$productService = $this->get('odiseo.product.service');
		$pager = $productService->findProductWithFiltersPager($filters, $page);
			
		if ($request->isXmlHttpRequest())
		{
			$imagesDirectoryPath = $this->container->getParameter('images_directory_path');
			$path = $this->generateUrl('liip_imagine_filter', array('filter' => 'product_list', 'path' => '/'));
			$imagePath = $path.''.$imagesDirectoryPath.'/';
			
			return new JsonResponse(array(
				'products' => json_encode($pager->getCurrentPageResults()),
			    'extraData' => array('size' => $pager->getNbResults(), 'images_directory_path' => $imagePath,
			    		            'pager' => array( 'haveToPaginate' => $pager->haveToPaginate() ,   
			    		            		           'paginatorHtml' => $this->renderView('OdiseoProductBundle:Frontend/Product/Partial:pagination.html.twig', array('pager' => $pager))   )
			    ),
					
			));
		}
		else
		{	
			$productTypes = $productService->findAllTypes();
			$locationService =  $this->get('odiseo.ecommerce.location.service');
			$towns = $locationService->findAllTowns();
			
			return $this->render('OdiseoProductBundle:Frontend/Product:index.html.twig', array(
				'pager' => $pager, 
				'productTypes' => $productTypes, 
				'towns' => $towns,
				'filters' =>json_encode( $filters),
			));
		}
	}
	
	public function showAction(Request $request)
	{
		$id = $request->get('id');
		$productService = $this->get('odiseo.product.service');
		
		$product = $productService->findOneBy('id', $id);
		
		return $this->render('OdiseoProductBundle:Frontend/Product:show.html.twig', array(
			'product' => $product
		));
	}	
	
	public function newAction(Request $request)
	{
		$form = $this->createForm(new ProductFormType(), null, array('action' => $this->generateUrl('odiseo_product_new')));
		if($request->isMethod('POST'))
		{
			$form->handleRequest($request);
			if ($form->isValid())
			{
				$user = $this->get('security.context')->getToken()->getUser();
				$product = $form->getData();
				$product->setVendor($user);
				$productService = $this->get('odiseo.product.service');
				$productService->addNewProduct($product, new ProductState());
				return $this->redirect($this->generateUrl('odiseo_product_show', array('id' => $product->getid())));
			}
			else {
				// formr invalido mostrar errores de validación.
			}
		}
	
		return $this->render('OdiseoProductBundle:Frontend/Product:new.html.twig', array('form' => $form->createView()));
	}
	
	private function getSelectedTown($filters)
	{	
	}
	
    public function searchProductsForUserNameAction($username)
    {    	
    	$service = $this->get('odiseo.user.service');
    	$products = $service->getProductsForUsername($username);
    	return new JsonResponse(array( 'products' => json_encode($products) , 'size' => count($products)));
    }    
    
    public function filterAction( $key , $value )
    {
		//TODO: Tirar ServiceException ("invalid key for filter")
    	$service = $this->get('odiseo.product.service');
    	$filterResult  = $service->findBy($key, $value);
    	return new JsonResponse(array( 'products' => json_encode($filterResult) , 'size' => count($filterResult)));
    }
}
