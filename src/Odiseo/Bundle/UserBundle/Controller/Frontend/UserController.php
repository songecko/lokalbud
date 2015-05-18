<?php

namespace Odiseo\Bundle\UserBundle\Controller\Frontend;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class UserController extends Controller
{
    public function addToWishlistAction($idWish)
    { 		
 		$user = null;
 		$user= $this->get('security.context')->getToken()->getUser();
 		if ($user != null)
 		{
 			$userId = $user->getId(); 
 			$wishService = $this->get('wishService');
 			$productService = $this->get('productService');
 			
 			$wished = $productService->findOneBy('id' ,$idWish);
 			$wish = $wishService->addWishToOwner($wished, $userId);
 			return new JsonResponse(array('error' => false));
 		}
 		else
 		{
 			return new JsonResponse(array('error' => 'true')); 			
 		}
 	}	
}