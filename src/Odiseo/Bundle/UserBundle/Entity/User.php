<?php

namespace Odiseo\Bundle\UserBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use DateTime;

/**
 * User
 */
class User extends BaseUser
{    
  	private $createdAt;
  	private $updatedAt; 
  	private $profiles;
  	private $products;
  	private $orders;

    public function __construct()
    {
    	parent::__construct();
    	$this->createdAt = new DateTime('now');
    	$this->profiles =  new ArrayCollection();
    	$this->products =  new ArrayCollection();
    	$this->orders =  new ArrayCollection();
    }
    
	public function getCreatedAt() 
	{
		return $this->createdAt;
	}
	
	public function setCreatedAt($createdAt) 
	{
		$this->createdAt = $createdAt;
		return $this;
	}
	
	public function getUpdatedAt() 
	{
		return $this->updatedAt;
	}
	
	public function setUpdatedAt($updatedAt) 
	{
		$this->updatedAt = $updatedAt;
		return $this;
	}    
	
	public function getProfiles()
	{
		return $this->profiles;
	}
	
	public function setProfiles($profiles)
	{	
	}
	
	public function getProducts() 
	{
		return $this->products;
	}
	
	public function setProducts($products) 
	{
	}
	
	public function getOrders() 
	{
		return $this->orders;
	}
	
	public function setOrders($orders) 
	{	
	}
}