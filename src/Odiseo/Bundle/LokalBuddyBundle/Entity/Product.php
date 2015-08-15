<?php
namespace Odiseo\Bundle\LokalBuddyBundle\Entity;

use JsonSerializable;
use Odiseo\Bundle\EcommerceBundle\Model\Product as BaseProduct;

class Product extends BaseProduct
{
	protected $maxQuantity;

	public function getMaxQuantity()
	{
		return $this->maxQuantity;
	}
	
	public function setMaxQuantity($maxQuantity)
	{
		$this->maxQuantity = $maxQuantity;
		return $this;
	}
	
}