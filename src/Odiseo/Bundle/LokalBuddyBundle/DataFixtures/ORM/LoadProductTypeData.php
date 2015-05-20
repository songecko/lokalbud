<?php

namespace Odiseo\Bundle\AdsCandyBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Finder\Finder;
use Odiseo\Bundle\ProjectBundle\DataFixtures\ORM\DataFixture;
use Odiseo\Bundle\UserBundle\Entity\User;
use Odiseo\Bundle\ProductBundle\Entity\ProductType;

/**
 * Para cargar los datos:
 * php app/console doctrine:fixtures:load --fixtures=src/Odiseo/Bundle/ProductBundle/DataFixtures/ORM
 * @author Leandro
 *
 */
class LoadProductTypeData extends DataFixture
{
    public function load(ObjectManager $manager)
    {
    	$product = new ProductType();
    	$product->setDescription("Revista");
    	$manager->persist($product);
    	$this->addReference('revista', $product);
    	$manager->persist($product);

    	$product = new ProductType();
    	$product->setDescription("Diario");
    	$manager->persist($product);
    	$this->addReference('diario', $product);
    	$manager->persist($product);
    	
    	$product = new ProductType();
    	$product->setDescription("Televisión");
    	$manager->persist($product);
    	$this->addReference('television', $product);
    	$manager->persist($product);

    	$product = new ProductType();
    	$product->setDescription("Internet");
    	$manager->persist($product);
    	$this->addReference('internet', $product);
    	$manager->persist($product);
    	
    	$product = new ProductType();
    	$product->setDescription("Cines");
    	$manager->persist($product);
    	$this->addReference('cine', $product);
    	$manager->persist($product);
    	
    	$product = new ProductType();
    	$product->setDescription("Móvil");
    	$manager->persist($product);
    	$this->addReference('movil', $product);
    	$manager->persist($product);
    	
    	$product = new ProductType();
    	$product->setDescription("Eventos");
    	$manager->persist($product);
    	$this->addReference('evento', $product);
    	$manager->persist($product);
    	
    	$product = new ProductType();
    	$product->setDescription("Redes Sociales");
    	$manager->persist($product);
    	$this->addReference('social', $product);
    	$manager->persist($product);
    	
    	$manager->flush();
    }
    
    public function getOrder()
    {
    	return 10;
    }
}