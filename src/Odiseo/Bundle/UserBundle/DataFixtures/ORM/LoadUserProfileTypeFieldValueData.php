<?php

namespace Odiseo\Bundle\UserBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Finder\Finder;
use Odiseo\Bundle\ProjectBundle\DataFixtures\ORM\DataFixture;
use Odiseo\Bundle\UserBundle\Entity\UserProfileTypeFieldValue;

/**
 * Para cargar los datos:
 * php app/console doctrine:fixtures:load --fixtures=src/Odiseo/Bundle/UserBundle/DataFixtures/ORM
 * @author Leandro
 */
class LoadUserProfileTypeFieldValueData extends DataFixture
{
    public function load(ObjectManager $manager)
    {
    	$fieldValue= new UserProfileTypeFieldValue();
    	$fieldValue->setIdProfileField($this->getReference('fieldEmpresa')->getId());
    	$fieldValue->setValue("Odiseo");
    	$fieldValue->setIdUser($this->getReference('user1')->getId());
    	$manager->persist($fieldValue);
    	
    	$fieldValue= new UserProfileTypeFieldValue();
    	$fieldValue->setIdProfileField($this->getReference('rubroField')->getId());
    	$fieldValue->setValue("Sistemas");
    	$fieldValue->setIdUser($this->getReference('user1')->getId());
    	$manager->persist($fieldValue);
    	
    	$fieldValue= new UserProfileTypeFieldValue();
    	$fieldValue->setIdProfileField($this->getReference('premiosField')->getId());
    	$fieldValue->setValue("Best Company Software Award");
    	$fieldValue->setIdUser($this->getReference('user1')->getId());
    	$manager->persist($fieldValue);
    	
    	$fieldValue= new UserProfileTypeFieldValue();
    	$fieldValue->setIdProfileField($this->getReference('razonSocialField')->getId());
    	$fieldValue->setValue("Soltero");
    	$fieldValue->setIdUser($this->getReference('user2')->getId());
    	$manager->persist($fieldValue);
    	
    	$fieldValue= new UserProfileTypeFieldValue();
    	$fieldValue->setIdProfileField($this->getReference('preferenciasField')->getId());
    	$fieldValue->setValue("Programación");
    	$fieldValue->setIdUser($this->getReference('user2')->getId());
    	$manager->persist($fieldValue);
    	
    	
    	$fieldValue= new UserProfileTypeFieldValue();
    	$fieldValue->setIdProfileField($this->getReference('descripcionField')->getId());
    	$fieldValue->setValue("Capo y Audaz");
    	$fieldValue->setIdUser($this->getReference('user2')->getId());
    	$manager->persist($fieldValue);
    	
    	
    	$manager->flush();
    }
    
    public function getOrder()
    {
    	return 6;
    }
}