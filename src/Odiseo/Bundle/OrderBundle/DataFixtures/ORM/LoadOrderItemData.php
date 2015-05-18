<?php

namespace Odiseo\Bundle\OrderBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Finder\Finder;
use Odiseo\Bundle\ProjectBundle\DataFixtures\ORM\DataFixture;
use Odiseo\Bundle\OrderBundle\Entity\OrderItem;

/**
 * Para cargar los datos:
 * php app/console doctrine:fixtures:load --fixtures=src/Odiseo/Bundle/OrderBundle/DataFixtures/ORM
 * @author Leandro
 */
class LoadOrderItemData extends DataFixture
{
    public function load(ObjectManager $manager)
    {
    	$data = new OrderItem();
    	$data->setProduct($this->getReference('product1'));
    	$data->setOrder($this->getReference('order1'));
    	$data->setDescription("Primer orden");
    	$manager->persist($data);
    	 
   	    $data = new OrderItem();
    	$data->setProduct($this->getReference('product1'));
    	$data->setOrder($this->getReference('order2'));
    	$data->setDescription("Segunda orden");
    	$manager->persist($data);
    	$manager->flush();
    	
    }
    
    public function getOrder()
    {
    	return 5;
    }
}