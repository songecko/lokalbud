<?php

namespace Odiseo\Bundle\ProductBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Finder\Finder;
use Odiseo\Bundle\ProjectBundle\DataFixtures\ORM\DataFixture;
use Odiseo\Bundle\ProductBundle\Entity\ProductTypeFieldValue;

/**
 * Para cargar los datos:
 * php app/console doctrine:fixtures:load --fixtures=src/Odiseo/Bundle/ProductBundle/DataFixtures/ORM
 * @author Leandro
 *
 */
class LoadProductTypeFieldValueData extends DataFixture
{
    public function load(ObjectManager $manager)
    {
    	for ($i = 1 ; $i <= 10; $i++){
    		$fieldValue= new ProductTypeFieldValue();
    		$fieldValue->setIdProduct($this->getReference('product'.$i)->getId());
    		$fieldValue->setIdProductField($this->getReference('pagina_revista')->getId());
    		$fieldValue->setValue(1);
    		$manager->persist($fieldValue);
    		
    		$fieldValue= new ProductTypeFieldValue();
    		$fieldValue->setIdProduct($this->getReference('product'.$i)->getId());
    		$fieldValue->setIdProductField($this->getReference('lectores')->getId());
    		$fieldValue->setValue(14543);
    		$manager->persist($fieldValue);
    		
    		$fieldValue= new ProductTypeFieldValue();
    		$fieldValue->setIdProduct($this->getReference('product'.$i)->getId());
    		$fieldValue->setIdProductField($this->getReference('público')->getId());
    		$fieldValue->setValue('joven');
    		$manager->persist($fieldValue);
    	
    	}
    	
    	/*for ($i = 10 ; $i < 15; $i++){
    		$fieldValue= new ProductTypeFieldValue();
    		$fieldValue->setIdProduct($this->getReference('product'.$i)->getId());
    		$fieldValue->setIdProductField($this->getReference('canal')->getId());
    		$fieldValue->setValue(7);
    		$manager->persist($fieldValue);
    		
    		$fieldValue= new ProductTypeFieldValue();
    		$fieldValue->setIdProduct($this->getReference('product'.$i)->getId());
    		$fieldValue->setIdProductField($this->getReference('hora')->getId());
    		$fieldValue->setValue('15:30');
    		$manager->persist($fieldValue);
    		
    		$fieldValue= new ProductTypeFieldValue();
    		$fieldValue->setIdProduct($this->getReference('product'.$i)->getId());
    		$fieldValue->setIdProductField($this->getReference('raiting')->getId());
    		$fieldValue->setValue(23);
    		$manager->persist($fieldValue);
    		
    		$fieldValue= new ProductTypeFieldValue();
    		$fieldValue->setIdProduct($this->getReference('product'.$i)->getId());
    		$fieldValue->setIdProductField($this->getReference('programa')->getId());
    		$fieldValue->setValue("Futbol Permitido");
    		$manager->persist($fieldValue);
    	}*/
    	
    	$fieldValue= new ProductTypeFieldValue();
    	$fieldValue->setIdProduct($this->getReference('product1')->getId());
    	$fieldValue->setIdProductField($this->getReference('audiencia')->getId());
    	$fieldValue->setValue("Adultos");
    	$manager->persist($fieldValue);
    	
    	$fieldValue= new ProductTypeFieldValue();
    	$fieldValue->setIdProduct($this->getReference('product1')->getId());
    	$fieldValue->setIdProductField($this->getReference('tipo')->getId());
    	$fieldValue->setValue("Fiesta 15");
    	$manager->persist($fieldValue);
    	
    	$fieldValue= new ProductTypeFieldValue();
    	$fieldValue->setIdProduct($this->getReference('product1')->getId());
    	$fieldValue->setIdProductField($this->getReference('invitados')->getId());
    	$fieldValue->setValue("300");
    	$manager->persist($fieldValue);
    	
    	$manager->flush();
    }
    
    public function getOrder()
    {
    	return 4;
    }
}