<?php

namespace Odiseo\Bundle\ProductBundle\Entity;

use DateTime;

/**
 * ProductTypeFieldValue
 */
class ProductTypeFieldValue
{
    /**
     * @var integer
     */
    private $idProduct;
    private $idProductField;
    private $value;
    
    public function __construct()
    {
    }
    
	public function getIdProduct() 
	{
		return $this->idProduct;
	}
	
	public function setIdProduct($idProduct) 
	{
		$this->idProduct = $idProduct;
		return $this;
	}
	
	public function getIdProductField() 
	{
		return $this->idProductField;
	}
	
	public function setIdProductField($idProductField) 
	{
		$this->idProductField = $idProductField;
		return $this;
	}
	
	public function getValue() 
	{
		return $this->value;
	}
	
	public function setValue($value) 
	{
		$this->value = $value;
		return $this;
	}	
}