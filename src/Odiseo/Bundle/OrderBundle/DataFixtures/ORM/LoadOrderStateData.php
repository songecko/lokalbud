<?php

namespace Odiseo\Bundle\OrderBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Finder\Finder;
use Odiseo\Bundle\ProjectBundle\DataFixtures\ORM\DataFixture;
use Odiseo\Bundle\OrderBundle\Entity\OrderState;

/**
 * Para cargar los datos:
 * php app/console doctrine:fixtures:load --fixtures=src/Odiseo/Bundle/OrderBundle/DataFixtures/ORM
 * @author Leandro
 */
class LoadOrderStateData extends DataFixture
{
    public function load(ObjectManager $manager)
    {
    	$state1 = new OrderState();
    	$state1->setName("requested");
    	$this->addReference('orderState1', $state1);
    	
    	
    	$state2 = new OrderState();
    	$state2->setName("pending");
    	$this->addReference('orderState2', $state2);
    	
    	$state3 = new OrderState();
    	$state3->setName("confirmed");
    	$this->addReference('orderState3', $state3);
    	
    	$state1->setNextState($this->getReference('orderState2'));
    	
    	$state2->setPreviousState($this->getReference('orderState1'));
    	$state2->setNextState($this->getReference('orderState3'));

    	$state3->setPreviousState($this->getReference('orderState2'));
    	
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