<?php

namespace Odiseo\Bundle\LokalBuddyBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Finder\Finder;
use Odiseo\Bundle\ProjectBundle\DataFixtures\ORM\DataFixture;
use Odiseo\Bundle\UserBundle\Entity\UserProfile;
use Odiseo\Bundle\UserBundle\Entity\UserProfileType;

/**
 * Para cargar los datos:
 * php app/console doctrine:fixtures:load --fixtures=src/Odiseo/Bundle/LokalBuddyBundle/DataFixtures/ORM
 * @author Leandro
 */
class LoadUserProfileData extends DataFixture
{
    public function load(ObjectManager $manager)
    {
    	$userProfile = new UserProfile();
    	
    	$userProfile->setAddress('Rondeau 1121');
    	$userProfile->setFirstName("Pepe");
    	$userProfile->setLastName("Paredes");
    	$userProfile->setPhone("123-123123");
    	$userProfile->setUser($this->getReference('user1'));
    	$this->addReference('profile1', $userProfile);
    	$manager->persist($userProfile);
    	
    	$userProfile = new UserProfile();
    	$userProfile->setAddress('Helguera 1121');
    	$userProfile->setFirstName("Carlos");
    	$userProfile->setLastName("Garcia");
    	$userProfile->setPhone("123-123123123");
    	$userProfile->setUser($this->getReference('user2'));
    	$this->addReference('profile2', $userProfile);
    	$manager->persist($userProfile);

    	$manager->flush();
    }
    
    public function getOrder()
    {
    	return 24;
    }
}