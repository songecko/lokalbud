<?php
namespace Odiseo\Bundle\ProductBundle\Tests\Entity;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Odiseo\Bundle\AdsCandyBundle\Filters\OrFilter;
use Odiseo\Bundle\AdsCandyBundle\Filters\RangeFilter;
use Odiseo\Bundle\AdsCandyBundle\Filters\WhereQueryBuilder;
use Odiseo\Bundle\AdsCandyBundle\Tests\Entity\BaseRepositoryFunctionalTest;

/**
 *Para correr este test: phpunit -c app src/Odiseo/Bundle/AdsCandyBundle/Tests/Entity/ProductRepositoryFunctionalTest.php
 * @author Leandro
 */
class ProductRepositoryFunctionalTest extends BaseRepositoryFunctionalTest
{

	public function setUp()
	{
		self::bootKernel();
		parent::setUp();
		$this->repositoryName = "OdiseoProductBundle:Product";
	}

	
	
	public function testState()
	{
		$media = $this->em->getRepository($this->repositoryName)->findOneById(1);
		$this->assertNotNull($media->getState());
	}
	
	
	public function testFilterProductsByTown()
	{
		$products = $this->em->getRepository($this->repositoryName)->filterByTown();
		$this->assertEquals(5 , count($products));
	}
	
	public function testFilterProductsByTypes()
	{
		$products = $this->em->getRepository($this->repositoryName)->filterByProductType();
		$this->assertEquals(15 , count($products));
	}
	public function testFilterProductsByRange()
	{
		$minValue = 1.5;
		$maxValue = 2.5;
		$products = $this->em->getRepository($this->repositoryName)->filterByPriceRange($minValue, $maxValue);
		$this->assertEquals(10 , count($products));
	}
	
	public function testFindProductWithOneFilter(){
		$filters = array();
		$values =  array(70, 76);
		$filters[] = new OrFilter('p', 'town', $values );
		$result = $this->em->getRepository($this->repositoryName)->findProductWithFilters($filters);
		$this->assertEquals(6 , count($result));
	}
	
	public function testFindProductWithTwoFilter(){
		$filters = array();
		$values =  array(70, 76);
		$filters[] = new OrFilter('p', 'town', $values );
		$types = array(1);
		$filters[] = new OrFilter('p', 'type', $types );
		$result = $this->em->getRepository($this->repositoryName)->findProductWithFilters($filters);
		$this->assertEquals(4 , count($result));
	}
	
	
	public function testFindProductWithThreeFilter(){
		$filters = array();
		$values =  array(69, 70);
		$filters[] = new OrFilter('p', 'town', $values );
		$types = array(1,2,3);
		$filters[] = new OrFilter('p', 'type', $types );
		$pricesRange = array(4,8);
		$filters[] = new RangeFilter('p', 'price', $pricesRange );
		$result = $this->em->getRepository($this->repositoryName)->findProductWithFilters($filters);
		$this->assertEquals(3 , count($result));
	}

}