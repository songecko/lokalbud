<?php

namespace Odiseo\Bundle\LokalBuddyBundle\Controller\Frontend;

use Symfony\Component\HttpFoundation\Request;
use Sylius\Bundle\WebBundle\Controller\Frontend\HomepageController as BaseHomepageController;

class HomepageController extends BaseHomepageController
{
    public function mainAction()
    {    	
    	$productService = $this->get('odiseo_product.service.product');
		$productTypes = $productService->findAllTypes();
		$locationService =  $this->get('odiseo_region.service.location');
		$towns = $locationService->findAllTowns();
    	return $this->render('OdiseoLokalBuddyBundle:Frontend/Homepage:main.html.twig' , array('productTypes' =>  $productTypes , 'towns' => json_encode($towns)));
    }   
}