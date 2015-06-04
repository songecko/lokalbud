<?php

namespace Odiseo\Bundle\LokalBuddyBundle\DataFixtures\ORM;

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
class LoadSettingsData extends DataFixture
{
    public function load(ObjectManager $manager)
    {
    	$settingsNamespaceValues = array('general' => array(
    		'title' => 'LokalBuddy - Local experiences',
    		'meta_keywords' => 'local, experiences, lokal, buddy, lokalbuddy, ecommerce',
    		'meta_description' => 'We offer a platform to make local experiences',
    		'locale' => 'en_US',
    		'currency' => 'USD'
    	));
    	
    	$settingsManager = $this->get('sylius.settings.manager');
    	
    	foreach ($settingsNamespaceValues as $namespace => $settingsValues)
    	{
	        $settings = $settingsManager->loadSettings($namespace);
	        
	        foreach ($settingsValues as $settingKey => $settingValue)
	        {
		        $settings->set($settingKey, $settingValue);	        	
	        }
	        
	        $settingsManager->saveSettings($namespace, $settings);    		
    	}
    }
    
    public function getOrder()
    {
    	return 50;
    }
}