<?php

namespace Odiseo\Bundle\LokalBuddyBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Finder\Finder;
use Odiseo\Bundle\ProjectBundle\DataFixtures\ORM\DataFixture;
use Odiseo\Bundle\ProductBundle\Entity\ProductTypeFieldValue;

/**
 * Para cargar los datos:
 * php app/console doctrine:fixtures:load --fixtures=src/Odiseo/Bundle/LokalBuddyBundle/DataFixtures/ORM
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
    		$fieldValue->setIdProductField($this->getReference('tipo_comida')->getId());
    		$fieldValue->setValue('argentina');
    		$manager->persist($fieldValue);
    		
    		$fieldValue= new ProductTypeFieldValue();
    		$fieldValue->setIdProduct($this->getReference('product'.$i)->getId());
    		$fieldValue->setIdProductField($this->getReference('tipo_tour')->getId());
    		$fieldValue->setValue('educacional');
    		$manager->persist($fieldValue);
    		
    		$fieldValue= new ProductTypeFieldValue();
    		$fieldValue->setIdProduct($this->getReference('product'.$i)->getId());
    		$fieldValue->setIdProductField($this->getReference('tipo_actividad')->getId());
    		$fieldValue->setValue('paseo');
    		$manager->persist($fieldValue);
    	
    	}
    	
    	$manager->flush();
    }
    
    public function getOrder()
    {
    	return 14;
    }
}