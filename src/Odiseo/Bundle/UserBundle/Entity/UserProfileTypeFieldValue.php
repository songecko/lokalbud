<?php

namespace Odiseo\Bundle\UserBundle\Entity;
use DateTime;

/**
 * UserProfileTypeValue
 */
class UserProfileTypeFieldValue
{
    /**
     * @var integer
     */
    private $idUser;
    private $idProfileField;
    private $value;
    
    public function __construct()
    {
    }
    
	public function getIdUser() 
	{
		return $this->idUser;
	}
	
	public function setIdUser($idUser) 
	{
		$this->idUser = $idUser;
		return $this;
	}
	
	public function getIdProfileField() 
	{
		return $this->idProfileField;
	}
	
	public function setIdProfileField($idProfileField) 
	{
		$this->idProfileField = $idProfileField;
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