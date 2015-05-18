<?php

namespace Odiseo\Bundle\UserBundle\Services;

use Odiseo\Bundle\UserBundle\Entity\UserWishlist;
use Doctrine\DBAL\Exception;
use Odiseo\Bundle\EcommerceBundle\Services\BaseDbService;

class UserWishlistService extends BaseDbService
{
	private $wishRepository;
	
	public function __construct($em , $wishRepository)
	{
		parent::__construct($em);
		$this->wishRepository = $wishRepository;
	}
	
	public function findOwnerWishes($ownerId)
	{
		return $this->wishRepository->findAll();
	}
	
	public function addWishToOwner($wished, $ownerId)
	{	
		$wish = new UserWishlist();
		try{
			$wish->setWished($wished);
			$wish->setOwnerId($ownerId);
			$this->saveOrUpdate($wish);
		}
		catch ( UniqueConstraintViolationException $e)  
		{ }
			
		return $wish;
	}
}