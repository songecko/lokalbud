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
    	$productType = new ProductType();
    	$productType->setDescription("Foods");
    	$manager->persist($productType);
    	$this->addReference('foods', $productType);

    	$productType = new ProductType();
    	$productType->setDescription("Tours");
    	$manager->persist($productType);
    	$this->addReference('tours', $productType);
    	
    	$productType = new ProductType();
    	$productType->setDescription("Activities");
    	$manager->persist($productType);
    	$this->addReference('activities', $productType);
    	
    	$manager->flush();
    }
    
    public function getOrder()
    {
    	return 5;
    }
}