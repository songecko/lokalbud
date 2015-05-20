<?php

namespace Odiseo\Bundle\LokalBuddyBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Finder\Finder;
use Odiseo\Bundle\ProjectBundle\DataFixtures\ORM\DataFixture;
use Odiseo\Bundle\OrderBundle\Entity\Order;

/**
 * Para cargar los datos:
 * php app/console doctrine:fixtures:load --fixtures=src/Odiseo/Bundle/LokalBuddyBundle/DataFixtures/ORM
 * @author Leandro
 */
class LoadOrderData extends DataFixture
{
    public function load(ObjectManager $manager)
    {
    	$data = new Order();
    	$data->setBuyer($this->getReference('buyer3'));
    	$this->addReference('order1', $data);
    	$manager->persist($data);
    	
    	$data = new Order();
    	$data->setBuyer($this->getReference('buyer3'));
    	$this->addReference('order2', $data);
    	$manager->persist($data);
    	$manager->flush();
    }
    
    public function getOrder()
    {
    	return 31;
    }
}