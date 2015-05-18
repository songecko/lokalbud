<?php
namespace Odiseo\Bundle\ProductBundle\Tests\Entity;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Odiseo\Bundle\AdsCandyBundle\Entity\UserProfile;
use Odiseo\Bundle\AdsCandyBundle\Tests\Entity\BaseRepositoryFunctionalTest;


/**
 *Para correr este test: phpunit -c app src/Odiseo/Bundle/AdsCandyBundle/Tests/Entity/ProductTypeFieldValuesRepositoryFunctionalTest.php
 * @author Leandro
 */
class ProductTypeFieldValuesRepositoryFunctionalTest extends BaseRepositoryFunctionalTest
{
	public function setUp()
	{
		self::bootKernel();
		parent::setUp();
		$this->repositoryName = "OdiseoProductBundle:ProductTypeFieldValue";
	}

	
	public function testFindById()
	{
		$this->assertNotNull("true", "No tiene esta entidad."); //para que no se ejecute el findById del padre.
	}
	
	public function testFindUserProductFieldValues(){
		$values = $this->em->getRepository($this->repositoryName)->findByIdProduct(1);
		$this->assertEquals( 3 , count($values) );
	}
	
}