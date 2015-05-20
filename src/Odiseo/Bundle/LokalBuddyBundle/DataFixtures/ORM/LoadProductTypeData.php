<?php

namespace Odiseo\Bundle\LokalBuddyBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Finder\Finder;
use Odiseo\Bundle\ProjectBundle\DataFixtures\ORM\DataFixture;
use Odiseo\Bundle\UserBundle\Entity\User;
use Odiseo\Bundle\ProductBundle\Entity\ProductType;

/**
 * Para cargar los datos:
 * php app/console doctrine:fixtures:load --fixtures=src/Odiseo/Bundle/LokalBuddyBundle/DataFixtures/ORM
 * @author Leandro
 *
 */
class LoadProductTypeData extends DataFixture
{
    public function load(ObjectManager $manager)
    {
    	$product = new ProductType();
    	$product->setDescription("Comida");
    	$manager->persist($product);
    	$this->addReference('comida', $product);
    	$manager->persist($product);

    	$product = new ProductType();
    	$product->setDescription("Tour");
    	$manager->persist($product);
    	$this->addReference('tour', $product);
    	$manager->persist($product);
    	
    	$product = new ProductType();
    	$product->setDescription("Actividad");
    	$manager->persist($product);
    	$this->addReference('actividad', $product);
    	$manager->persist($product);
    	
    	$manager->flush();
    }
    
    public function getOrder()
    {
    	return 10;
    }
}