<?php

namespace Odiseo\Bundle\UserBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use DateTime;

/**
 * UserProfileType
 */
class UserProfileType
{
    /**
     * @var integer
     */
    private $id;
    private $name;
    private $fields;
   
    
    public function __construct()
    {
    	$this->fiedls = new ArrayCollection();
    	
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
	
	public function getName() {
		return $this->name;
	}
	public function setName($name) {
		$this->name = $name;
		return $this;
	}
	public function getFields() {
		return $this->fields;
	}
	public function setFields($fields) {
		$this->fields = $fields;
		return $this;
	}
	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	
}

