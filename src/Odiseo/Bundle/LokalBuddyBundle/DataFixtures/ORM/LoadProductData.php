<?php

namespace Odiseo\Bundle\AdsCandyBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Finder\Finder;
use Odiseo\Bundle\ProjectBundle\DataFixtures\ORM\DataFixture;
use Odiseo\Bundle\ProductBundle\Entity\Product;
use Odiseo\Bundle\ProductBundle\Entity\ProductAsset;
use Symfony\Component\HttpFoundation\File\UploadedFile;
/**
 * Para cargar los datos:
 * php app/console doctrine:fixtures:load --fixtures=src/Odiseo/Bundle/ProductBundle/DataFixtures/ORM
 * @author Leandro
 *
 */
class LoadProductData extends DataFixture
{
    public function load(ObjectManager $manager)
    {    	
    	$towns = array(
			'Arroyo', 'Guayama', 'Guayanilla', 'Juana Díaz', 'Patillas',
			'Peñuelas', 'Ponce', 'Salinas', 'Santa Isabel', 'Villalba'
    	);
    	
    	$states = array('state1', 'state2', 'state3');
    	
    	$types = array('revista', 'diario', 'television', 'internet', 'cine', 'movil', 'evento', 'social');
    	
    	$pIndex = 0;
    	foreach ($towns as $town)
    	{
    		for ($i = 0 ; $i < 10; $i++)
    		{
    			$pIndex++;
    			
    			$product = new Product();
    			$product->setTitle($this->faker->text(20));
    			$product->setShortDescription($this->faker->text(150));
		    	$product->setDescription($this->faker->paragraph());
		    	$price = $this->faker->randomFloat(2, 100, 1500);
		    	$product->setPrice($price);
		    	$product->setOldPrice($price+100);
		    	$product->setQuantity($this->faker->numberBetween(0, 150));
		    	$product->setState($this->getReference($states[array_rand($states)]));	
		    	$product->setType($this->getReference($types[array_rand($types)]));
		    	$product->setVendor($this->getReference('user1'));
				$product->setTown($this->getReference($town));
				$product->setLatitud(18.1987192 + $i*0.002 );
				$product->setLongitud(-66.3526747 + $i*0.002);
				$product->setAddress("Avenida Callao 648");
				//Load assets
				$this->loadAssetsForProduct($manager, $product);
				
				$this->addReference('product'.$pIndex, $product);
		    	$manager->persist($product);
    		}
    	}
    	
    	$manager->flush();
    }
    
    public function loadAssetsForProduct(ObjectManager $manager, $product)
    {
    	$imageDirectoryFinder = new Finder();
    	$imageFinder = new Finder();
    	
    	$imagesPath = __DIR__.'/../../Resources/fixtures/product/images';
    	
    	$maxImageVariants = count($imageDirectoryFinder->directories()->in($imagesPath));
    	
    	$i = 0;
    	foreach ($imageFinder->files()->in($imagesPath.'/'.rand(1,$maxImageVariants)) as $img) 
    	{
    		$pAsset = new ProductAsset();
    		$pAsset->setProduct($product);
    		$pAsset->setFile(new UploadedFile($img->getRealPath(), $img->getFilename()));
    		$pAsset->setPosition($i);
    	
    		$manager->persist($pAsset);
    		
    		$i++;
    	}	
    }
    
    public function getOrder()
    {
    	return 12;
    }
}