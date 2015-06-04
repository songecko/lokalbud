<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Odiseo\Bundle\LokalBuddyBundle\DataFixtures\ORM;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Persistence\ObjectManager;
use Sylius\Bundle\FixturesBundle\DataFixtures\DataFixture;
use Sylius\Component\Core\Model\ProductInterface;
use Sylius\Component\Product\Model\AttributeValueInterface;
use Sylius\Component\Taxation\Model\TaxCategoryInterface;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Default assortment products to play with Sylius.
 *
 * @author Paweł Jędrzejewski <pawel@sylius.org>
 * @author Gonzalo Vilaseca <gvilaseca@reiss.co.uk>
 */
class LoadProductsData extends DataFixture
{
    /**
     * Total variants created.
     *
     * @var integer
     */
    private $totalVariants = 0;

    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
    	$regionTowns = array(
    		'Oeste' => array(
    			'Aguada', 'Aguadilla', 'Añasco', 'Cabo Rojo', 'Guánica'
    		)
    	);
    	
    	$types = array('foods', 'tours', 'activities');
    	
    	$pIndex = 0;
    	foreach ($regionTowns as $regionName => $towns)
    	{
    		foreach ($towns as $town)
    		{
    			for ($i = 0 ; $i < 10; $i++)
    			{
    				$pIndex++;
    				$product = $this->createProduct($pIndex, $town, $types[array_rand($types)]);
    				$this->loadImagesForProduct($manager, $product);
					$manager->persist($product);
            	}
    		}
        }

        $manager->flush();

        $this->defineTotalVariants();
    }

    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 6;
    }

    /**
     * Creates product.
     *
     * @param integer $i
     *
     * @return ProductInterface
     */
    protected function createProduct($i, $town, $type)
    {
        $product = $this->createNewProduct();
        $product->setTaxCategory($this->getTaxCategory('Taxable goods'));

        $translatedNames = array(
            $this->defaultLocale =>sprintf($type.' "%s"', $this->faker->word),
            'es_ES' => sprintf($type.' "%s"', $this->fakers['es_ES']->word),
        );
        $this->addTranslatedFields($product, $translatedNames);

        $product->setVariantSelectionMethod(ProductInterface::VARIANT_SELECTION_MATCH);

        $this->addMasterVariant($product);

        //Vendor
        $product->setVendor($this->getReference('user1'));
        
        //Town
        $product->setTown($this->getReference('Odiseo.Town.'.$town));
        
        //Location
        $product->setLatitud(18.1987192 + $i*0.002 );
        $product->setLongitud(-66.3526747 + $i*0.002);
        $product->setAddress("Avenida Callao 648");
        
        /**TODO VER en el futuro si usamos esta caracteristicas**/
        //$this->setTaxons($product, array('T-Shirts', 'SuperTees'));
        //$product->setArchetype($this->getReference('Sylius.Archetype.t_shirt'));
        
        //$randomBrand = $this->faker->randomElement(array('Nike', 'Adidas', 'Puma', 'Potato'));
        //$this->addAttribute($product, 'T-Shirt brand', $randomBrand);
        
        //$product->addOption($this->getReference('Sylius.Option.T-Shirt size'));
        //$product->addOption($this->getReference('Sylius.Option.T-Shirt color'));
		//$this->generateVariants($product);

        $this->setReference('Sylius.Product.'.$i, $product);

        return $product;
    }

    private function loadImagesForProduct(ObjectManager $manager, $product)
    {
    	$imageDirectoryFinder = new Finder();
    	$imageFinder = new Finder();
    	 
    	$imagesPath = __DIR__.'/../../Resources/fixtures/product/images';
    	 
    	$maxImageVariants = count($imageDirectoryFinder->directories()->in($imagesPath));
    	 
    	$uploader = $this->get('sylius.image_uploader');
    	
    	$i = 0;
    	foreach ($imageFinder->files()->in($imagesPath.'/'.rand(1,$maxImageVariants)) as $img)
    	{
    		$image = $this->getProductVariantImageRepository()->createNew();
    		$image->setFile(new UploadedFile($img->getRealPath(), $img->getFilename()));
    		$uploader->upload($image);
    		
    		$manager->persist($image);
    		
    		$variant = $product->getMasterVariant();
    		$variant->addImage($image);
    
    		$i++;
    	}
    }
    
    /**
     * Generates all possible variants with random prices.
     *
     * @param ProductInterface $product
     */
    protected function generateVariants(ProductInterface $product)
    {
        $this
            ->getVariantGenerator()
            ->generate($product)
        ;

        foreach ($product->getVariants() as $variant) {
            $variant->setAvailableOn($this->faker->dateTimeThisYear);
            $variant->setPrice($this->faker->randomNumber(4));
            $variant->setSku($this->getUniqueSku());
            $variant->setOnHand($this->faker->randomNumber(1));

            $this->setReference('Sylius.Variant-'.$this->totalVariants, $variant);

            ++$this->totalVariants;
        }
    }

    /**
     * Adds master variant to product.
     *
     * @param ProductInterface $product
     * @param string           $sku
     */
    protected function addMasterVariant(ProductInterface $product, $sku = null)
    {
        $variant = $product->getMasterVariant();
        $variant->setProduct($product);
        $variant->setPrice($this->faker->randomNumber(4));
        //$variant->setSku(null === $sku ? $this->getUniqueSku() : $sku);
        //$variant->setAvailableOn($this->faker->dateTimeThisYear);
        //$variant->setOnHand($this->faker->randomNumber(1));

        /*$productName = explode(' ', $product->getName());
        $image = clone $this->getReference(
            'Sylius.Image.'.strtolower($productName[0])
        );
        $variant->addImage($image);*/

        $this->setReference('Sylius.Variant-'.$this->totalVariants, $variant);

        ++$this->totalVariants;

        $product->setMasterVariant($variant);
    }

    /**
     * Adds attribute to product with given value.
     *
     * @param ProductInterface $product
     * @param string           $name
     * @param string           $value
     */
    private function addAttribute(ProductInterface $product, $name, $value)
    {
        /* @var $attribute AttributeValueInterface */
        $attribute = $this->getProductAttributeValueRepository()->createNew();
        $attribute->setAttribute($this->getReference('Sylius.Attribute.'.$name));
        $attribute->setProduct($product);
        $attribute->setValue($value);

        $product->addAttribute($attribute);
    }

    /**
     * Adds taxons to given product.
     *
     * @param ProductInterface $product
     * @param array            $taxonNames
     */
    protected function setTaxons(ProductInterface $product, array $taxonNames)
    {
        $taxons = new ArrayCollection();

        foreach ($taxonNames as $taxonName) {
            $taxons->add($this->getReference('Sylius.Taxon.'.$taxonName));
        }

        $product->setTaxons($taxons);
    }

    /**
     * Get tax category by name.
     *
     * @param string $name
     *
     * @return TaxCategoryInterface
     */
    protected function getTaxCategory($name)
    {
        return $this->getReference('Sylius.TaxCategory.'.ucfirst($name));
    }

    /**
     * Create new product instance.
     *
     * @return ProductInterface
     */
    protected function createNewProduct()
    {
        return $this->getProductRepository()->createNew();
    }

    /**
     * Define constant with number of total variants created.
     */
    protected function defineTotalVariants()
    {
        define('SYLIUS_FIXTURES_TOTAL_VARIANTS', $this->totalVariants);
    }

    private function addTranslatedFields(ProductInterface $product, $translatedNames)
    {
        foreach ($translatedNames as $locale => $name) {
            $product->setCurrentLocale($locale);
            $product->setFallbackLocale($locale);

            $product->setName($name);
            $product->setDescription($this->fakers[$locale]->paragraph);
            $product->setShortDescription($this->fakers[$locale]->sentence);
            $product->setMetaKeywords(str_replace(' ', ', ', $this->fakers[$locale]->sentence));
            $product->setMetaDescription($this->fakers[$locale]->sentence);
        }

        $product->setCurrentLocale($this->defaultLocale);
    }
}
