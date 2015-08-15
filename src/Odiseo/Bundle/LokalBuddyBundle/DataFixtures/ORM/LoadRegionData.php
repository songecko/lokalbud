<?php

namespace Odiseo\Bundle\LokalBuddyBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Finder\Finder;
use Odiseo\Bundle\ProjectBundle\DataFixtures\ORM\DataFixture;
use Odiseo\Bundle\OrderBundle\Model\Order;
use Odiseo\Bundle\RegionBundle\Model\Region;

/**
 * Para cargar los datos:
 * php app/console doctrine:fixtures:load --fixtures=src/Odiseo/Bundle/PetsPortalBundle/DataFixtures/ORM
 */
class LoadRegionData extends DataFixture
{
	public function load(ObjectManager $manager)
	{
		$i = 2;
		$region = new Region();
		$region->setName('Norte');
		$this->addReference('Norte', $region);
		$region->setLatitud(18.3154292 + $i/1000);
		$region->setLongitud(-65.9751463,17 + $i/1000);
		$manager->persist($region);
		 
		 
		$region = new Region();
		$region->setName('Sur');
		$this->addReference('Sur', $region);
		$i = 3;
		$region->setLatitud(18.3154292 + $i/1000);
		$region->setLongitud(-65.9751463,17 + $i/1000);
		$manager->persist($region);

		$region = new Region();
		$region->setName('Centro');
		$this->addReference('Centro', $region);
		$i = 4;
		$region->setLatitud(18.3154292 + $i/1000);
		$region->setLongitud(-65.9751463,17 + $i/1000);
		$manager->persist($region);
		 
		$region = new Region();
		$region->setName('Metro');
		$i = 5;
		$region->setLatitud(18.3154292 + $i/1000);
		$region->setLongitud(-65.9751463,17 + $i/1000);
		$this->addReference('Metro', $region);
		$manager->persist($region);
		 
		$region = new Region();
		$region->setName('Oeste');
		$i = 6;
		$region->setLatitud(18.3154292 + $i/1000);
		$region->setLongitud(-65.9751463,17 + $i/1000);
		$this->addReference('Oeste', $region);
		$manager->persist($region);
		 
		$region = new Region();
		$region->setName('Este');
		$i = 7;
		$region->setLatitud(18.3154292 + $i/1000);
		$region->setLongitud(-65.9751463,17 + $i/1000);
		$this->addReference('Este', $region);
		$manager->persist($region);
		 
		$manager->flush();
	}

	public function getOrder()
	{
		return 1;
	}
}