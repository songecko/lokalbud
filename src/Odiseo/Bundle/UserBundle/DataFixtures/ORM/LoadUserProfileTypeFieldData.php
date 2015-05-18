<?php

namespace Odiseo\Bundle\UserBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Finder\Finder;
use Odiseo\Bundle\ProjectBundle\DataFixtures\ORM\DataFixture;
use Odiseo\Bundle\UserBundle\Entity\UserProfileTypeField;

/**
 * Para cargar los datos:
 * php app/console doctrine:fixtures:load --fixtures=src/Odiseo/Bundle/UserBundle/DataFixtures/ORM
 * @author Leandro
 */
class LoadUserProfileTypeFieldData extends DataFixture
{
    public function load(ObjectManager $manager)
    {
    	$profileField = new UserProfileTypeField();
	    $profileField->setName("empresa");
	    $profileField->setProfileType($this->getReference('vendorProfile'));
	    $this->addReference('fieldEmpresa', $profileField);
	    $manager->persist($profileField);
	    
	    $profileField = new UserProfileTypeField();
	    $profileField->setName("rubro");
	    $profileField->setProfileType($this->getReference('vendorProfile'));
   		$this->addReference('rubroField', $profileField);
	    $manager->persist($profileField);
	    
	    $profileField = new UserProfileTypeField();
	    $profileField->setName("premios");
	    $profileField->setProfileType($this->getReference('vendorProfile'));
	    $this->addReference('premiosField', $profileField);
	    $manager->persist($profileField);
	    
	    $profileField = new UserProfileTypeField();
	    $profileField->setName("razon social");
	    $profileField->setProfileType($this->getReference('buyerProfile'));
	    $this->addReference('razonSocialField', $profileField);
	    $manager->persist($profileField);
	     
	    $profileField = new UserProfileTypeField();
	    $profileField->setName("preferencias");
	    $profileField->setProfileType($this->getReference('buyerProfile'));
	    $this->addReference('preferenciasField', $profileField);
	    $manager->persist($profileField);
	     
	    $profileField = new UserProfileTypeField();
	    $profileField->setName("descripcion");
	    $profileField->setProfileType($this->getReference('buyerProfile'));
	    $this->addReference('descripcionField', $profileField);
	    $manager->persist($profileField);
    	
    	
    	$manager->flush();
    }
    
    public function getOrder()
    {
    	return 5;
    }
}