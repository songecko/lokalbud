<?php

namespace Odiseo\Bundle\LokalBuddyBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Finder\Finder;
use Odiseo\Bundle\ProjectBundle\DataFixtures\ORM\DataFixture;
use Odiseo\Bundle\EcommerceBundle\Entity\Message;

/**
 * Para cargar los datos:
 * php app/console doctrine:fixtures:load --fixtures=src/Odiseo/Bundle/LokalBuddyBundle/DataFixtures/ORM
 * @author Leandro
 */
class LoadMessageData extends DataFixture
{
    public function load(ObjectManager $manager)
    {
		for($i = 0 ; $i < 5 ; $i++){
			$msg = new Message();
			$msg->setBody("Hola te quería consultar por el medio...");
			$msg->setSubject("Nuevo");
			if($i&1) {
				$msg->setSender($this->getReference("user1"));
				$msg->setReceiver($this->getReference("user2"));
			}
			else{
				$msg->setSender($this->getReference("user2"));
				$msg->setReceiver($this->getReference("user1"));
			}
			$msg->setProduct($this->getReference('Sylius.Product.1'));
			$msg->setIsReaded(false);
			$msg->setIsSent(true);
			$msg->setIsDeleted(false);
			$manager->persist($msg);
		}
		
		for($i = 5 ; $i < 10 ; $i++){
			$msg = new Message();
			$msg->setBody("Hola te quería consultar por el medio...");
			$msg->setSubject("Leido");
			if($i&1) {
			$msg->setSender($this->getReference("user1"));
			$msg->setReceiver($this->getReference("user2"));
			}
			else{
				$msg->setSender($this->getReference("user2"));
				$msg->setReceiver($this->getReference("user1"));
			}
			$msg->setProduct($this->getReference('Sylius.Product.2'));
			$msg->setIsReaded(true);
			$msg->setIsSent(true);
			$msg->setIsDeleted(false);
			$manager->persist($msg);
		}
		
		for($i = 10 ; $i < 15 ; $i++){
			$msg = new Message();
			$msg->setBody("Hola te quería consultar por el medio...");
			$msg->setSubject("Borrador");
			if($i&1) {
			$msg->setSender($this->getReference("user1"));
			$msg->setReceiver($this->getReference("user2"));
			}
			else{
				$msg->setSender($this->getReference("user2"));
				$msg->setReceiver($this->getReference("user1"));
			}
			$msg->setIsReaded(false);
			$msg->setProduct($this->getReference('Sylius.Product.3'));
			$msg->setIsSent(false);
			$msg->setIsDeleted(false);
			$manager->persist($msg);
		}
		
		for($i = 15 ; $i < 20 ; $i++){
			$msg = new Message();
			$msg->setBody("Hola te quería consultar por el medio...");
			$msg->setSubject("Eliminado");
			if($i&1) {
			$msg->setSender($this->getReference("user1"));
			$msg->setReceiver($this->getReference("user2"));
			}
			else{
				$msg->setSender($this->getReference("user2"));
				$msg->setReceiver($this->getReference("user1"));
			}
			$msg->setProduct($this->getReference('Sylius.Product.4'));
			$msg->setIsReaded(false);
			$msg->setIsSent(false);
			$msg->setIsDeleted(true);
			$manager->persist($msg);
		}
    	
    	$manager->flush();
    }
    
    public function getOrder()
    {
    	return 40;
    }
}