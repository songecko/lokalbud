<?php

namespace Odiseo\Bundle\LokalBuddyBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Finder\Finder;
use Odiseo\Bundle\ProjectBundle\DataFixtures\ORM\DataFixture;
use Odiseo\Bundle\UserBundle\Entity\User;

/**
 * Para cargar los datos:
 * php app/console doctrine:fixtures:load --fixtures=src/Odiseo/Bundle/LokalBuddyBundle/DataFixtures/ORM --append
 * @author Leandro
 */
class LoadUserData extends DataFixture
{
    public function load(ObjectManager $manager)
    {   
    	$user1 = new User();
    	$user1->setUsername('user1');
    	$user1->setUsernameCanonical('user1');
    	$user1->setEmail('usuarioA@example.com');
    	$user1->setEmailCanonical('usuarioA@example.com');
    	$user1->setPlainPassword('123456');
    	$user1->setEnabled(true);
    	$this->addReference('user1', $user1);
    	$manager->persist($user1);    	
    	    	
    	$user2 = new User();
    	$user2->setUsername('user2');
    	$user2->setUsernameCanonical('user2');
    	$user2->setEmail('usuarioB@example.com');
    	$user2->setEmailCanonical('usuarioB@example.com');
    	$user2->setPlainPassword('123456');
    	$user2->setEnabled(true);
    	$this->addReference('user2', $user2);
    	$manager->persist($user2);
    	
    	$user3 = new User();
    	$user3->setUsername('buyer3');
    	$user3->setUsernameCanonical('buyer3');
    	$user3->setEmail('buyer3@example.com');
    	$user3->setEmailCanonical('buyer3@example.com');
    	$user3->setPlainPassword('123456');
    	$user3->setEnabled(true);
    	$this->addReference('buyer3', $user3);
    	$manager->persist($user3);
    	
    	$manager->flush();
    }
    
    public function getOrder()
    {
    	return 11;
    }
}