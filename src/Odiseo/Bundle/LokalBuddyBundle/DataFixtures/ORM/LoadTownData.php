<?php

namespace Odiseo\BundleLokalBuddyBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Finder\Finder;
use Odiseo\Bundle\ProjectBundle\DataFixtures\ORM\DataFixture;
use Odiseo\Bundle\OrderBundle\Entity\Order;
use Odiseo\Bundle\EcommerceBundle\Entity\Town;

/**
 * Para cargar los datos:
 * php app/console doctrine:fixtures:load --fixtures=src/Odiseo/Bundle/LokalBuddyBundle/DataFixtures/ORM
 * @author Leandro
 */
class LoadTownData extends DataFixture
{
    public function load(ObjectManager $manager)
    {
    	$municipios = array(
    	'Aguada',
    	'Aguadilla',
    	'Añasco',
    	'Cabo Rojo',
    	'Guánica',
    	'Hormigueros',
    	'Isabela',
    	'Lajas',
    	'Las Marías',
    	'Maricao',
    	'Mayagüez',
    	'Moca',
    	'Rincón',
    	'Sabana Grande',
    	'San Germán',
    	'San Sebastián');
    	
    	foreach ($municipios as &$townName) {
    		$town = new Town();
    		$town->setName($townName);
    		$town->setRegion($this->getReference('Oeste'));
    		$this->addReference($townName , $town);
    		$manager->persist($town);
    	}
    	
    	$municipios = array(
    	'Arroyo',
    	'Guayama',
    	'Guayanilla',
    	'Juana Díaz',
    	'Patillas',
    	'Peñuelas',
    	'Ponce',
    	'Salinas',
    	'Santa Isabel',
    	'Villalba',
    	'Yauco');
    	
    	foreach ($municipios as &$townName) {
    		$town = new Town();
    		$town->setName($townName);
    		$town->setRegion($this->getReference('Sur'));
    		$this->addReference($townName , $town);
    		$manager->persist($town);
    	}
    	
    	$municipios = array(
    	'Arecibo',
    	'Barceloneta',
    	'Camuy',
    	'Hatillo',
    	'Manatí',
    	'Quebradillas',
    	'Vega Alta',
    	'Vega Baja');
    	
    	foreach ($municipios as &$townName) {
    		$town = new Town();
    		$town->setName($townName);
    		$town->setRegion($this->getReference('Norte'));
    		$this->addReference($townName , $town);
    		$manager->persist($town);
    	}
   		
    	$municipios = array(
    	'Bayamón',
    	'Caguas',
    	'Carolina',
    	'Carolina - Isla Verde',
    	'Cataño',
    	'Dorado',
    	'Guaynabo',
    	'San Juan-Condado-Miramar',
    	'San Juan-Hato Rey',
    	'San Juan-Río Piedras',
    	'San Juan-Santurce',
    	'San Juan-Viejo SJ',
    	'Toa Baja',
    	'Toa Baja-Levittown',
    	'Trujillo Alto');		
   		
    	foreach ($municipios as &$townName) {
    		$town = new Town();
    		$town->setName($townName);
    		$town->setRegion($this->getReference('Metro'));
    		$this->addReference($townName , $town);
    		$manager->persist($town);
    	}
    	
    	
    	$municipios = array(
    	'Adjuntas',
    	'Aguas Buenas',
    	'Aibonito',
    	'Barranquitas',
    	'Cayey',
    	'Ciales',
    	'Cidra',
    	'Coamo',
    	'Comerío',
    	'Corozal',
    	'Florida',
    	'Jayuya',
    	'Lares',
    	'Morovis',
    	'Naranjito',
    	'Orocovis',
    	'Toa Alta',
    	'Utuado');
    	
    	foreach ($municipios as &$townName) {
    		$town = new Town();
    		$town->setName($townName);
    		$town->setRegion($this->getReference('Centro'));
    		$this->addReference($townName , $town);
    		$manager->persist($town);
    	}
    	
    	$municipios = array(
    	'Canovanas',
    	'Ceiba',
    	'Culebra',
    	'Fajardo',
    	'Gurabo',
    	'Humacao',
    	'Humacao-Palmas',
    	'Juncos',
    	'Las Piedras',
    	'Loiza',
    	'Luquillo',
    	'Maunabo',
    	'Naguabo',
    	'Río Grande',
    	'San Lorenzo',
    	'Vieques',
    	'Yabucoa');
    	
    	foreach ($municipios as &$townName) {
    		$town = new Town();
    		$town->setName($townName);
    		$town->setRegion($this->getReference('Este'));
    		$this->addReference($townName , $town);
    		$manager->persist($town);
    	}
    	
    	$manager->flush();
    }
    
    public function getOrder()
    {
    	return 2;
    }
}