<?php

namespace Odiseo\Bundle\UserBundle\Entity;

use DateTime;

/**
 * Order
 */
class UserWishlist
{ 
    private $id;
    private $ownerId;
    private $wished;
    private $dateCreated;
    
    public function __construct()
    {
    	$this->dateCreated = new DateTime('now');
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
    
    public function setId($id)
    {
    	$this->id = $id;
    }
	
	public function getOwnerId() 
	{
		return $this->ownerId;
	}
	
	public function setOwnerId($owner_id) 
	{
		$this->ownerId = $owner_id;
		return $this;
	}
	
	public function getWished() 
	{
		return $this->wished;
	}
	
	public function setWished($wished) 
	{
		$this->wished = $wished;
		return $this;
	}
	
	public function getDateCreated() 
	{
		return $this->dateCreated;
	}
	
	public function setDateCreated($dateCreated) 
	{
		$this->dateCreated = $dateCreated;
		return $this;
	}	
}