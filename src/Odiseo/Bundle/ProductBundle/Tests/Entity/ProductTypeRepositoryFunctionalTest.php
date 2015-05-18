<?php
namespace Odiseo\Bundle\ProductBundle\Tests\Entity;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Odiseo\Bundle\ProductBundle\Entity\ProductType;
use Odiseo\Bundle\AdsCandyBundle\Tests\Entity\BaseRepositoryFunctionalTest;

/**
 *Para correr este test: phpunit -c app src/Odiseo/Bundle/ProductBundle/Tests/Entity/ProductTypeRepositoryFunctionalTest.php
 * @author Leandro
 */
class ProductTypeRepositoryFunctionalTest extends BaseRepositoryFunctionalTest
{

	public function setUp()
	{
		self::bootKernel();
		parent::setUp();
		$this->repositoryName = "OdiseoProductBundle:ProductType";
	}

}