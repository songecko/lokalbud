<?php

namespace Odiseo\Bundle\AdsCandyBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Finder\Finder;
use Odiseo\Bundle\ProjectBundle\DataFixtures\ORM\DataFixture;
use Odiseo\Bundle\ProductBundle\Entity\ProductTypeField;
/**
 * Para cargar los datos:
 * php app/console doctrine:fixtures:load --fixtures=src/Odiseo/Bundle/ProductBundle/DataFixtures/ORM
 * @author Leandro
 *
 */
class LoadProductTypeFieldData extends DataFixture
{
    public function load(ObjectManager $manager)
    {
    	$productField = new ProductTypeField();
    	$productField->setName("Pagina");
    	$productField->setProductType($this->getReference("revista"));
	    $this->addReference("pagina_revista", $productField);
    	$manager->persist($productField);
    	
    	$productField = new ProductTypeField();
    	$productField->setName("lectores");
    	$productField->setProductType($this->getReference("revista"));
    	$this->addReference("lectores", $productField);
    	$manager->persist($productField);
    	
    	$productField = new ProductTypeField();
    	$productField->setName("público");
    	$productField->setProductType($this->getReference("revista"));
    	$this->addReference("público", $productField);
    	$manager->persist($productField);
    	
    	
    	$productField = new ProductTypeField();
    	$productField->setName("Pagina");
    	$productField->setProductType($this->getReference("diario"));
    	$this->addReference("pagina", $productField);
    	$manager->persist($productField);
    	 
    	$productField = new ProductTypeField();
    	$productField->setName("seccion");
    	$productField->setProductType($this->getReference("diario"));
    	$this->addReference("seccion", $productField);
    	$manager->persist($productField);
    	 
    	$productField = new ProductTypeField();
    	$productField->setName("tirada");
    	$productField->setProductType($this->getReference("diario"));
    	$this->addReference("tirada", $productField);
    	$manager->persist($productField);
    	
    	
    	$productField = new ProductTypeField();
    	$productField->setName("canal");
    	$productField->setProductType($this->getReference("television"));
    	$this->addReference("canal", $productField);
    	$manager->persist($productField);
    	
    	$productField = new ProductTypeField();
    	$productField->setName("hora");
    	$productField->setProductType($this->getReference("television"));
    	$this->addReference("hora", $productField);
    	$manager->persist($productField);
    	
    	$productField = new ProductTypeField();
    	$productField->setName("raiting");
    	$productField->setProductType($this->getReference("television"));
    	$this->addReference("raiting", $productField);
    	$manager->persist($productField);
    	
    	$productField = new ProductTypeField();
    	$productField->setName("programa");
    	$productField->setProductType($this->getReference("television"));
    	$this->addReference("programa", $productField);
    	$manager->persist($productField);
    	
    	
    	$productField = new ProductTypeField();
    	$productField->setName("url");
    	$productField->setProductType($this->getReference("internet"));
    	$this->addReference("url", $productField);
    	$manager->persist($productField);
    	 
    	$productField = new ProductTypeField();
    	$productField->setName("layer");
    	$productField->setProductType($this->getReference("internet"));
    	$this->addReference("layer", $productField);
    	$manager->persist($productField);
    	 
    	$productField = new ProductTypeField();
    	$productField->setName("visitas_diarias");
    	$productField->setProductType($this->getReference("internet"));
    	$this->addReference("visitas_diarias", $productField);
    	$manager->persist($productField);
    	 
    	$productField = new ProductTypeField();
    	$productField->setName("tematica");
    	$productField->setProductType($this->getReference("internet"));
    	$this->addReference("tematica", $productField);
    	$manager->persist($productField);


    	$productField = new ProductTypeField();
    	$productField->setName("pelicula");
    	$productField->setProductType($this->getReference("cine"));
    	$this->addReference("pelicula", $productField);
    	$manager->persist($productField);
    	
    	$productField = new ProductTypeField();
    	$productField->setName("audiencia");
    	$productField->setProductType($this->getReference("cine"));
    	$this->addReference("audiencia_pelicula", $productField);
    	$manager->persist($productField);
    	
    	$productField = new ProductTypeField();
    	$productField->setName("productor");
    	$productField->setProductType($this->getReference("cine"));
    	$this->addReference("productor", $productField);
    	$manager->persist($productField);
    	
    	$productField = new ProductTypeField();
    	$productField->setName("horario");
    	$productField->setProductType($this->getReference("movil"));
    	$this->addReference("horario", $productField);
    	$manager->persist($productField);
    	 
    	$productField = new ProductTypeField();
    	$productField->setName("frecuencia");
    	$productField->setProductType($this->getReference("movil"));
    	$this->addReference("frecuencia", $productField);
    	$manager->persist($productField);
    	 
    	$productField = new ProductTypeField();
    	$productField->setName("tipo");
    	$productField->setProductType($this->getReference("evento"));
    	$this->addReference("tipo", $productField);
    	$manager->persist($productField);
    	
    	$productField = new ProductTypeField();
    	$productField->setName("Invitados");
    	$productField->setProductType($this->getReference("evento"));
    	$this->addReference("invitados", $productField);
    	$manager->persist($productField);
    	
    	$productField = new ProductTypeField();
    	$productField->setName("audiencia");
    	$productField->setProductType($this->getReference("evento"));
    	$this->addReference("audiencia", $productField);
    	$manager->persist($productField);
    	
    	$productField = new ProductTypeField();
    	$productField->setName("red");
    	$productField->setProductType($this->getReference("social"));
    	$this->addReference("red", $productField);
    	$manager->persist($productField);
    	 
    	$productField = new ProductTypeField();
    	$productField->setName("seguidores");
    	$productField->setProductType($this->getReference("social"));
    	$this->addReference("seguidores", $productField);
    	$manager->persist($productField);
    	
    	$manager->flush();
    }
    
    public function getOrder()
    {
    	return 13;
    }
}