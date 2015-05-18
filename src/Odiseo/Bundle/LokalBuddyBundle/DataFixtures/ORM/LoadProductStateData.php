<?php

namespace Odiseo\Bundle\LokalBuddyBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Finder\Finder;
use Odiseo\Bundle\ProjectBundle\DataFixtures\ORM\DataFixture;
use Odiseo\Bundle\ProductBundle\Entity\ProductState;
/**
 * Para cargar los datos:
 * php app/console doctrine:fixtures:load --fixtures=src/Odiseo/Bundle/LokalBuddyBundle/DataFixtures/ORM
 * @author Leandro
 *
 */
class LoadProductStateData extends DataFixture
{
    public function load(ObjectManager $manager)
    {
    	
    	$state1 = new ProductState();
    	$state1->setName("available");
    	$this->addReference('state1', $state1);
    	
    	
    	$state2 = new ProductState();
    	$state2->setName("reserved");
    	$this->addReference('state2', $state2);
    	
    	$state3 = new ProductState();
    	$state3->setName("confirmed");
    	$this->addReference('state3', $state3);
    	
    	$state1->setNextState($this->getReference('state2'));
    	
    	$state2->setPreviousState($this->getReference('state1'));
    	$state2->setNextState($this->getReference('state3'));

    	$state3->setPreviousState($this->getReference('state2'));
    	
    	$manager->persist($state1);
    	$manager->persist($state2);
    	$manager->persist($state3);
    	
    	$manager->flush();
    	
    }
    
    public function getOrder()
    {
    	return 1;
    }
}