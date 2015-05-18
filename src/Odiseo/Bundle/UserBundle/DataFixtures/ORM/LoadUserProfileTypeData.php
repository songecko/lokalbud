<?php

namespace Odiseo\Bundle\UserBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Finder\Finder;
use Odiseo\Bundle\ProjectBundle\DataFixtures\ORM\DataFixture;
use Odiseo\Bundle\UserBundle\Entity\UserProfileType;

/**
 * Para cargar los datos:
 * php app/console doctrine:fixtures:load --fixtures=src/Odiseo/Bundle/UserBundle/DataFixtures/ORM/LoadUserProfileData
 * @author Leandro
 */
class LoadUserProfileTypeData extends DataFixture
{
    public function load(ObjectManager $manager)
    {
    	$profileType = new UserProfileType();
    	$profileType->setName("Vendor");
    	$this->addReference('vendorProfile', $profileType);
    	$manager->persist(   $profileType);
    	
    	$profileType = new UserProfileType();
    	$profileType->setName("Buyer");
    	$this->addReference('buyerProfile', $profileType);
    	$manager->persist( $profileType);
    	
    	$manager->flush();
    }
    
    public function getOrder()
    {
    	return 1;
    }
}