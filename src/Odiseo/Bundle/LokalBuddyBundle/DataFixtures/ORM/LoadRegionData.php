<?php

namespace Odiseo\Bundle\AdsCandyBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Finder\Finder;
use Odiseo\Bundle\ProjectBundle\DataFixtures\ORM\DataFixture;
use Odiseo\Bundle\OrderBundle\Entity\Order;
use Odiseo\Bundle\EcommerceBundle\Entity\Region;

/**
 * Para cargar los datos:
 * php app/console doctrine:fixtures:load --fixtures=src/Odiseo/Bundle/EcommerceBundle/DataFixtures/ORM
 * @author Leandro
 */
class LoadRegionData extends DataFixture
{
    public function load(ObjectManager $manager)
    {
    	$region = new Region();
    	$region->setName("Norte");
    	$this->addReference("Norte", $region);
   		$manager->persist($region);	
   		
   		$region = new Region();
   		$region->setName("Sur");
   		$this->addReference("Sur", $region);
   		$manager->persist($region);

   		$region = new Region();
   		$region->setName("Centro");
   		$this->addReference("Centro", $region);
   		$manager->persist($region);
   		
   		$region = new Region();
   		$region->setName("Metro");
   		$this->addReference("Metro", $region);
   		$manager->persist($region);
   		
   		$region = new Region();
   		$region->setName("Oeste");
   		$this->addReference("Oeste", $region);
   		$manager->persist($region);
   		
   		$region = new Region();
   		$region->setName("Este");
   		$this->addReference("Este", $region);
   		$manager->persist($region);
    	
    	$manager->flush();
    }
    
    public function getOrder()
    {
    	return 1;
    }
}