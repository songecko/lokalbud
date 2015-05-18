<?php

namespace Odiseo\Bundle\UserBundle\Entity;

use DateTime;

/**
 * UserProfileType
 */
class UserProfileTypeField
{
    /**
     * @var integer
     */
    private $id;
    private $name;
    private $profileType;
    
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
	public function getName() {
		return $this->name;
	}
	public function setName($name) {
		$this->name = $name;
		return $this;
	}
	
	public function getProfileType() {
		return $this->profileType;
	}
	public function setProfileType($profileType) {
		$this->profileType = $profileType;
		return $this;
	}
}

