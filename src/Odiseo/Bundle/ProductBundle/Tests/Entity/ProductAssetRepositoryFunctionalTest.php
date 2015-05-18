<?php
namespace Odiseo\Bundle\ProductBundle\Tests\Entity;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Odiseo\Bundle\AdsCandyBundle\Entity\Order;
use Odiseo\Bundle\AdsCandyBundle\Tests\Entity\BaseRepositoryFunctionalTest;


/**
 *  Para correr este test: phpunit -c app src/Odiseo/Bundle/AdsCandyBundle/Tests/Entity/ProductAssetRepositoryFunctionalTest.php
 */
class ProductAssetRepositoryFunctionalTest extends BaseRepositoryFunctionalTest
{

	public function setUp()
	{
		self::bootKernel();
		parent::setUp();
		$this->repositoryName = "OdiseoProductBundle:ProductAsset";
	}


}

