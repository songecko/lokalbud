<?php

namespace Odiseo\Bundle\OrderBundle\Entity;

use DateTime;

/**
 * Order
 */
class Order
{
    private $id;
    private $dateCreated;
    private $buyer;
    private $items;
    private $state;
    
    
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
    
    public function setId($id){
    	$this->id = $id;
    }
	public function getDateCreated() {
		return $this->dateCreated;
	}
	public function setDateCreated($dateCreated) {
		$this->dateCreated = $dateCreated;
		return $this;
	}
	public function getBuyer() {
		return $this->buyer;
	}
	public function setBuyer($buyer) {
		$this->buyer = $buyer;
		return $this;
	}
	public function getItems() {
		return $this->items;
	}
	public function getState() {
		return $this->state;
	}
	public function setState($state) {
		$this->state = $state;
		return $this;
	}
	
	
}

