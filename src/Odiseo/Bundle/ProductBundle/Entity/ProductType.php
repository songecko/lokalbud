<?php

namespace Odiseo\Bundle\ProductBundle\Entity;

/**
 * ProductType
 */
class ProductType
{
	private $id;
    private $description;
    private $fields;

    public function getId()
    {
        return $this->id;
    }
    
    public function setId($id)
    {
    	$this->id = $id;
    }
    
	public function getDescription() 
	{
		return $this->description;
	}
	
	public function setDescription($description) 
	{
		$this->description = $description;
		return $this;
	}
	
	public function getFields() 
	{
		return $this->fields;
	}
	
	public function setFields($fields) 
	{
		$this->fields = $fields;
		return $this;
	}
}