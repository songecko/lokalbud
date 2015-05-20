<?php

namespace Odiseo\Bundle\LokalBuddyBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Finder\Finder;
use Odiseo\Bundle\ProjectBundle\DataFixtures\ORM\DataFixture;
use Odiseo\Bundle\ProductBundle\Entity\ProductTypeField;
/**
 * Para cargar los datos:
 * php app/console doctrine:fixtures:load --fixtures=src/Odiseo/Bundle/LokalBuddyBundle/DataFixtures/ORM
 * @author Leandro
 *
 */
class LoadProductTypeFieldData extends DataFixture
{
    public function load(ObjectManager $manager)
    {
    	$productField = new ProductTypeField();
    	$productField->setName("Tipo comida");
    	$productField->setProductType($this->getReference("comida"));
	    $this->addReference("tipo_comida", $productField);
    	$manager->persist($productField);
    	
    	$productField = new ProductTypeField();
    	$productField->setName("Tipo tour");
    	$productField->setProductType($this->getReference("tour"));
    	$this->addReference("tipo_tour", $productField);
    	$manager->persist($productField);
    	
    	$productField = new ProductTypeField();
    	$productField->setName("Tipo actividad");
    	$productField->setProductType($this->getReference("actividad"));
    	$this->addReference("tipo_actividad", $productField);
    	$manager->persist($productField);
    	    	
    	$manager->flush();
    }
    
    public function getOrder()
    {
    	return 13;
    }
}