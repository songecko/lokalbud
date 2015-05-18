<?php

namespace Odiseo\Bundle\EcommerceBundle\Entity;

/**
 * Region
 */
class Region
{
    /**
     * @var integer
     */
    private $id;
    private $name;

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
	public function getName() {
		return $this->name;
	}
	
	public function setName($name) {
		$this->name = $name;
		return $this;
	}
}

