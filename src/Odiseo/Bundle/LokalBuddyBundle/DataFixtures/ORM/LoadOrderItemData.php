<?php

namespace Odiseo\Bundle\LokalBuddyBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Finder\Finder;
use Odiseo\Bundle\ProjectBundle\DataFixtures\ORM\DataFixture;
use Odiseo\Bundle\LokalBuddyBundle\Entity\OrderItem;

/**
 * Para cargar los datos:
 * php app/console doctrine:fixtures:load --fixtures=src/Odiseo/Bundle/LokalBuddyBundle/DataFixtures/ORM
 * @author Leandro
 */
class LoadOrderItemData extends DataFixture
{
    public function load(ObjectManager $manager)
    {
    	$data = new OrderItem();
    	$data->setProduct($this->getReference('product1'));
    	$data->setDescription("Primer orden");
    	$data->setOrder($this->getReference('order1'));
    	$this->addReference('orderItem1', $data);
    	$manager->persist($data);
    	 
   	    $data = new OrderItem();
    	$data->setProduct($this->getReference('product2'));
    	$data->setDescription("Segunda orden");
    	$data->setOrder($this->getReference('order2'));
		$this->addReference('orderItem2', $data);
    	$manager->persist($data);
    	
    	$manager->flush();    	
    }
    
    public function getOrder()
    {
    	return 32;
    }
}