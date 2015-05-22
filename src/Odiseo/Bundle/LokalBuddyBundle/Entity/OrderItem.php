<?php

namespace Odiseo\Bundle\LokalBuddyBundle\Entity;

use Odiseo\Bundle\OrderBundle\Entity\OrderItem as BaseOrderItem;

/**
 * Order Item
 */
class OrderItem extends BaseOrderItem
{
	protected $product;
	
	public function getProduct() 
	{
		return $this->product;
	}
	
	public function setProduct($product) 
	{
		$this->product = $product;
		return $this;
	}
}