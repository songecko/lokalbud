<?php

namespace Odiseo\Bundle\LokalBuddyBundle\Controller\Frontend;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends Controller
{
    public function indexAction(Request $request)
    {   
    	$productService = $this->get('odiseo.product.service');
		$productTypes = $productService->findAllTypes();
		$locationService =  $this->get('odiseo.ecommerce.location.service');
		$towns = $locationService->findAllTowns();
    	return $this->render('OdiseoLokalBuddyBundle:Frontend/Home:index.html.twig' , array('productTypes' =>  $productTypes , 'towns' => json_encode($towns)));
    }
    
}
