<?php

namespace Odiseo\Bundle\OrderBundle\Entity;

use DateTime;

/**
 * Order
 */
class OrderItem
{  
    private $id;
    private $description;
    private $product;
    private $order;

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
	public function getDescription() {
		return $this->description;
	}
	public function setDescription($description) {
		$this->description = $description;
		return $this;
	}
	public function getProduct() {
		return $this->product;
	}
	public function setProduct($product) {
		$this->product = $product;
		return $this;
	}
	public function getOrder() {
		return $this->order;
	}
	public function setOrder($order) {
		$this->order = $order;
		return $this;
	}
	
}

