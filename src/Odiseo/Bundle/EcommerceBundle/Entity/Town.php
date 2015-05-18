<?php

namespace Odiseo\Bundle\EcommerceBundle\Entity;

use JsonSerializable;

/**
 * Town
 */
class Town implements JsonSerializable
{
    /**
     * @var integer
     */
    private $id;
    private $name;
    private $region;


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
	public function getRegion() {
		return $this->region;
	}
	public function setRegion($region) {
		$this->region = $region;
		return $this;
	}
	
	
	public function jsonSerialize()
	{
		return array(
				'id' => $this->id,
				'name' => $this->name,
				'regionName' => $this->region->getName(),
				'regionId' => $this->region->getId(),
		);
	}
	
	
	
}

