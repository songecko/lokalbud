<?php

namespace Odiseo\Bundle\UserBundle\Services;

use Doctrine\Common\Collections\ArrayCollection;

class UserService extends BaseUserService 
{
	protected $profileTypeFieldValuesRepository;
	protected $profileTypeRepository;
	
	public function __construct($em , $userRepository, $profileTypeFieldValuesRepository, $profileTypeRepository ) 
	{
		parent::__construct($em, $userRepository);
		$this->profileTypeFieldValuesRepository = $profileTypeFieldValuesRepository;
		$this->profileTypeRepository = $profileTypeRepository;
	}
	
	public function getProfileTypeByName($profileName) 
	{
		$profileType = $this->profileTypeRepository->findOneByName($profileName);
		return $profileType;
	}
	
	public function getProfileTypePropertiesValues($user) 
	{
		$propertiesValues = array ();
		$profileType = $user->getProfiles()[0]->getType();
		$fields = $profileType->getFields ();
		$userId = $user->getId ();
		$values = $this->profileTypeFieldValuesRepository->findByIdUser( $userId );
		
		foreach ( $fields as $field ) {
			foreach ( $values as $value ) {
				if ($field->getId() == $value->getIdProfileField()){
					
					$propertiesValues[$field->getName()] =  $value->getValue();
				}
			}
		}
		return $propertiesValues;
	}
	
	public function findUserWish($userId)
	{	
	}
}