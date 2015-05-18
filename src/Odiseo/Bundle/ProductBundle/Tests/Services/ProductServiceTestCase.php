<?php
namespace Odiseo\Bundle\ProductBundle\Tests\Services;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Odiseo\Bundle\AdsCandyBundle\Services\UserService;
use Odiseo\Bundle\AdsCandyBundle\Filters\Filter;
use Odiseo\Bundle\AdsCandyBundle\Filters\FilterFactory;
use Odiseo\Bundle\AdsCandyBundle\Filters\FilterTypes;

/*
 * Para correr este test: phpunit -c app src/Odiseo/Bundle/AdsCandyBundle/Tests/Services/ProductServiceTestCase.php
 */
 
use Odiseo\Bundle\ProductBundle\Services\ProductService;
 
/**
 *  Para correr este test: phpunit -c app src/Odiseo/Bundle/Bundle/Tests/Services/ProductServiceTestCase.php
 * 
 * @author Leandro
 *
 */
class ProductServiceTestCase extends KernelTestCase
{
	/**
	 * @var \Doctrine\ORM\EntityManager
	 */

	/**
	 * {@inheritDoc}
	 */
	private $productService;
	private $filterFactory;

	
	public function setUp()
	{
		self::bootKernel();
		$this->productService = static::$kernel->getContainer()->get('productService');
		$this->filterFactory =  static::$kernel->getContainer()->get('filterFactory');
	}

	public function testOrdersByRegion()
	{
		//$medias = $this->mediaService->findMediaByRegion();
		$this->assertNotNull(1);
	}
	
	public function testFindAllProducts(){
		$products = $this->productService->findAll();
		$this->assertGreaterThan(5, count($products));
	}
	
	public function testFindAllType(){
		$types = $this->productService->findAllTypes();
		$this->assertGreaterThan(3, count($types));
	}
	
	public function testFindByKeyValue_one(){
		$products= $this->productService->findBy('type','1');
		$this->assertEquals(10, count($products));
	}
	
	public function testFindByKeyValue_two(){
		$products= $this->productService->findBy('type','3');
		$this->assertEquals(5, count($products));
	}
	
	public function testFindProductsWithOneFilter(){
		$filters = array();
		$args = array();
		$args['entityAlias'] = 'p';
		$args['entityProperty'] = 'town';
		$args['filterArgs'] = array(70, 76);
		$filter = $this->filterFactory->getFilterInstance(FilterFactory::OR_FILTER_TYPE , $args);
		$filters[] = $filter;
		$result = $this->productService->findProductWithFilters($filters);
		$this->assertEquals(6 , count($result));
		
	}
	
	public function testFindProductsWithTwoFilter(){
		$filters = array();
		$args = array();
		
		$args['entityAlias'] = 'p';
		$args['entityProperty'] = 'town';
		$args['filterArgs'] = array(70, 76);
		$filter = $this->filterFactory->getFilterInstance(FilterFactory::OR_FILTER_TYPE , $args);
		$filters[] = $filter;
		
		$args['entityAlias'] = 'p';
		$args['entityProperty'] = 'type';
		$args['filterArgs'] = array(1);
		$filter = $this->filterFactory->getFilterInstance(FilterFactory::OR_FILTER_TYPE , $args);
		$filters[] = $filter;
		
		$result = $this->productService->findProductWithFilters($filters);
		$this->assertEquals(4 , count($result));
	
	}
	
	public function testFindProductsWithThreeFilter(){
		$filters = array();
		$args = array();
	
		$args['entityAlias'] = 'p';
		$args['entityProperty'] = 'town';
		$args['filterArgs'] = array(69, 70);
		$filter = $this->filterFactory->getFilterInstance(FilterFactory::OR_FILTER_TYPE , $args);
		$filters[] = $filter;
	
		$args['entityAlias'] = 'p';
		$args['entityProperty'] = 'type';
		$args['filterArgs'] = array(1,2,3);
		$filter = $this->filterFactory->getFilterInstance(FilterFactory::OR_FILTER_TYPE , $args);
		$filters[] = $filter;
		
		$args['entityAlias'] = 'p';
		$args['entityProperty'] = 'price';
		$args['filterArgs'] = array(4,8);
		$filter = $this->filterFactory->getFilterInstance(FilterFactory::RANGE_FILTER_TYPE , $args);
		$filters[] = $filter;
	
		$result = $this->productService->findProductWithFilters($filters);
		$this->assertEquals(3 , count($result));
	
	}
	
	/**
	 * {@inheritDoc}
	 */
	protected function tearDown()
	{
		parent::tearDown();
	}
}