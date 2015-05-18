<?php

namespace Odiseo\Bundle\ProductBundle\Entity;

use Odiseo\Bundle\EcommerceBundle\Entity\BaseState;

/**
 * MediaState
 */
class ProductState extends BaseState
{
	const STATE_AVAILABLE = "available";
	const STATE_RESERVED = "reserved";
	const STATE_CONFIRMED = "confirmed";
	
	
	public function __construct()
	{
		$this->name = self::STATE_AVAILABLE;
		 
	}
	
}

