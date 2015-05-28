<?php

namespace Odiseo\Bundle\LokalBuddyBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Finder\Finder;
use Odiseo\Bundle\ProjectBundle\DataFixtures\ORM\DataFixture;
use Odiseo\Bundle\OrderBundle\Entity\Order;
use Odiseo\Bundle\UserBundle\Entity\UserWishlist;

/**
 * Para cargar los datos:
 * php app/console doctrine:fixtures:load --fixtures=src/Odiseo/Bundle/LokalBuddyBundle/DataFixtures/ORM
 * @author Leandro
 */
class LoadUserWishlistData extends DataFixture
{
    public function load(ObjectManager $manager)
    {
    	$wish = new UserWishlist();
    	$wish->setUser($this->getReference('user1'));
    	$wish->setWished($this->getReference('product5'));
   		$manager->persist($wish);	
    	
      	$wish = new UserWishlist();
    	$wish->setUser($this->getReference('user1'));
    	$wish->setWished($this->getReference('product6'));
    	$manager->persist($wish);	
    	
    	$wish = new UserWishlist();
    	$wish->setUser($this->getReference('user1'));
    	$wish->setWished($this->getReference('product7'));
    	$manager->persist($wish);	
    	
    	$manager->flush();
    }
    
    public function getOrder()
    {
    	return 25;
    }
}