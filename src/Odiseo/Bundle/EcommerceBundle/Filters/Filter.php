<?php

namespace Odiseo\Bundle\EcommerceBundle\Filters;

use Doctrine\ORM\Query\Expr;

/**
 * State 
 */
abstract class Filter
{
	/**
     * @var integer
     */
  	protected $expr;
    protected $entityAlias;
    protected $entityProperty;

    public function __construct($entityAlias , $entityProperty, $options )
    {
    	$this->expr = new Expr();
    	$this->entityAlias = $entityAlias;
    	$this->entityProperty = $entityProperty;
    	$this->setup($options);
    }
    
    protected abstract function setup($options);
    protected abstract function getExpression();
	
	public function getEntityAlias() 
	{
		return $this->entityAlias;
	}
	
	public function setEntityAlias($entityAlias) 
	{
		$this->entityAlias = $entityAlias;
		return $this;
	}
	
	public function getEntityProperty() 
	{
		return $this->entityProperty;
	}
	
	public function setEntityProperty($entityProperty) 
	{
		$this->entityProperty = $entityProperty;
		return $this;
	}	
}