<?php

namespace Odiseo\Bundle\LokalBuddyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use DateTime;
use Symfony\Component\HttpFoundation\File\File;
use Odiseo\Bundle\UserBundle\Entity\UserProfile as BaseUserProfile;

/**
 * UserProfile
 */
class UserProfile extends BaseUserProfile
{
    protected $passportName;
    protected $passportFile;
    protected $paypalId;
    
    
	public function getPassportName()
	{
		return $this->passportName;
	}
	
	public function setPassportName($passportName)
	{
		$this->passportName = $passportName;
		return $this;
	}
	
	public function getPassportFile()
	{
		return $this->passportFile;
	}
	
	public function setPassportFile(File $passportFile)
	{
		$this->passportFile = $passportFile;
		
		if ($passportFile) 
		{
			$this->updatedAt = new \DateTime('now');
		}
		
		return $this;
	}


	public function getPaypalId()
	{
		return $this->paypalId;
	}
	
	public function setPaypalId($paypalId)
	{
		$this->paypalId = $paypalId;
		return $this;
	}
}