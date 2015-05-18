<?php
namespace Odiseo\Bundle\ProductBundle\Tests\Entity;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Odiseo\Bundle\AdsCandyBundle\Tests\Entity\BaseRepositoryFunctionalTest;


/**
 * Para correr este test: phpunit -c app src/Odiseo/Bundle/ProductBundle/Tests/Entity/ProductStateRepositoryFunctionalTest.php
 * @var \Doctrine\ORM\EntityManager
 */

class ProductStateRepositoryFunctionalTest extends BaseRepositoryFunctionalTest
{
	
	public function setUp()
	{
		self::bootKernel();
		parent::setUp();
		$this->repositoryName = "OdiseoProductBundle:ProductState";
	}

	public function testNextState()
	{
		$product = $this->em->getRepository($this->repositoryName)->findOneById(1);
		$this->assertEquals( 2 , $product->getNextState()->getId(), "Testing Next State");
	}
	
	public function testPreviousState()
	{
		$product = $this->em->getRepository($this->repositoryName)->findOneById(1);
		$this->assertEquals( $product->getId() , $product->getNextState()->getPreviousState()->getId(),"Testing Previous State");
	}
}