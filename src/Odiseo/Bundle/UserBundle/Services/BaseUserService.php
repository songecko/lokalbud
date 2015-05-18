<?php

namespace Odiseo\Bundle\UserBundle\Services;

use Doctrine\Common\Collections\ArrayCollection;
use Odiseo\Bundle\EcommerceBundle\Services\BaseDbService;

class BaseUserService extends BaseDbService
{	
	protected $userRepository; 
	
	public function __construct($em , $userRepository)
	{
		parent::__construct($em);
		$this->userRepository = $userRepository;	
	}
	
	public function findById($userId)
	{
		$user = $this->userRepository->findOneById($userId);
		return $user;
	}
		
	public function getUserOrders($userId)
	{
		$orders = array();
		$user = $this->userRepository->findOneById($userId);
		if ($user != null){
			
			$orders = $user->getOrders();
		}
		return $orders;
	}
	
	public function getUserProducts($userId)
	{
		$products = array();
		$user = $this->userRepository->findOneById($userId);
		if ($user != null)
		{			
			$products = $user->getProducts();
		}
		return $products;
	}
	
	public function getProductsForUsername($username)
	{
		$medias = new ArrayCollection();
		$user = $this->userRepository->findOneByUsername($username);
		if ($user != null)
		{
			$medias = $user->getProducts();
		}
		return $medias->toArray();
	}
}