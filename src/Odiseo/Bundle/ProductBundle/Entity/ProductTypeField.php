<?php

namespace Odiseo\Bundle\ProductBundle\Entity;

use DateTime;

/**
 * ProfileType
 */
class ProductTypeField
{
    /**
     * @var integer
     */
    private $id;
    private $name;
    private $productType;
       
    public function __construct()
    {
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
    
	public function getName() 
	{
		return $this->name;
	}
	
	public function setName($name) 
	{
		$this->name = $name;
		return $this;
	}
	
	public function getProductType() 
	{
		return $this->productType;
	}
	
	public function setProductType($productType) 
	{
		$this->productType = $productType;
		return $this;
	}
}