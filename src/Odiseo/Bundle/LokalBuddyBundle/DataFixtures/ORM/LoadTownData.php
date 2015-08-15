<?php

namespace Odiseo\Bundle\LokalBuddyBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Finder\Finder;
use Odiseo\Bundle\ProjectBundle\DataFixtures\ORM\DataFixture;
use Odiseo\Bundle\OrderBundle\Model\Order;
use Odiseo\Bundle\RegionBundle\Model\Town;

/**
 * Para cargar los datos:
 * php app/console doctrine:fixtures:load --fixtures=src/Odiseo/Bundle/AdsCandyBundle/DataFixtures/ORM
 * @author Leandro
 */
class LoadTownData extends DataFixture
{
    public function load(ObjectManager $manager)
    {
    	$regionTowns = array(
    		'Oeste' => array(
    			'Aguada', 'Aguadilla', 'Añasco', 'Cabo Rojo', 'Guánica', 'Hormigueros',	'Isabela', 'Lajas',	'Las Marías',
				'Maricao', 'Mayagüez', 'Moca', 'Rincón', 'Sabana Grande', 'San Germán',	'San Sebastián'
    		),
    		'Sur' => array(
				'Arroyo', 'Guayama', 'Guayanilla', 'Juana Díaz', 'Patillas', 'Peñuelas', 'Ponce', 'Salinas', 'Santa Isabel', 'Villalba', 'Yauco'
    		),
    		'Norte' => array(
    			'Arecibo', 'Barceloneta', 'Camuy', 'Hatillo', 'Manatí', 'Quebradillas', 'Vega Alta', 'Vega Baja'
    		),
    		'Metro' => array(
				'Bayamón', 'Caguas', 'Carolina', 'Carolina - Isla Verde', 'Cataño', 'Dorado', 'Guaynabo', 'San Juan-Condado-Miramar',
				'San Juan-Hato Rey', 'San Juan-Río Piedras', 'San Juan-Santurce', 'San Juan-Viejo SJ', 'Toa Baja', 'Toa Baja-Levittown', 'Trujillo Alto'
    		),
    		'Centro' => array(
				'Adjuntas', 'Aguas Buenas', 'Aibonito', 'Barranquitas', 'Cayey', 'Ciales', 'Cidra', 'Coamo', 'Comerío', 'Corozal', 'Florida', 
    			'Jayuya', 'Lares', 'Morovis', 'Naranjito', 'Orocovis', 'Toa Alta', 'Utuado'
    		),
    		'Este' => array(
    			'Canovanas', 'Ceiba', 'Culebra', 'Fajardo', 'Gurabo', 'Humacao', 'Humacao-Palmas', 'Juncos', 'Las Piedras',
				'Loiza', 'Luquillo', 'Maunabo', 'Naguabo', 'Río Grande', 'San Lorenzo', 'Vieques', 'Yabucoa'
    		)
    	);
    	
    	$i = 0 ;
    	foreach ($regionTowns as $regionName => $towns) 
    	{
    		
    		foreach ($towns as $townName)
    		{
    			$town = new Town();
    			$town->setName($townName);
    			$town->setRegion($this->getReference($regionName));
    			$town->setLatitud(18.3154292 + $i/1000);
    			$town->setLongitud(-65.9751463,17 + $i/1000);
    			$this->addReference('Odiseo.Town.'.$townName, $town);
    			$manager->persist($town);
    			$i++;
    		}
    		
    		$manager->flush();
    	}   	
    }
    
    public function getOrder()
    {
    	return 2;
    }
}