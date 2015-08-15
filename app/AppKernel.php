<?php

use Sylius\Bundle\CoreBundle\Kernel\Kernel;
use Odiseo\Bundle\CoreBundle\OdiseoCoreBundle;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
        	new \Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle(),
        	new Vich\UploaderBundle\VichUploaderBundle(),
        	new \RaulFraile\Bundle\LadybugBundle\RaulFraileLadybugBundle(),
			new JavierEguiluz\Bundle\EasyAdminBundle\EasyAdminBundle(),
        	new Odiseo\Bundle\BackendBundle\OdiseoBackendBundle(),
			new Odiseo\Bundle\ProjectBundle\OdiseoProjectBundle(),
        	new Stfalcon\Bundle\TinymceBundle\StfalconTinymceBundle(),
            new FOS\MessageBundle\FOSMessageBundle(),
            new Odiseo\Bundle\ProductBundle\OdiseoProductBundle(),
        	new Odiseo\Bundle\UserBundle\OdiseoUserBundle(),
            new Odiseo\Bundle\MessagingBundle\OdiseoMessagingBundle(),
        	new Odiseo\Bundle\OrderBundle\OdiseoOrderBundle(),
		new Odiseo\Bundle\RegionBundle\OdiseoRegionBundle(),
            new Odiseo\Bundle\NotificationBundle\OdiseoNotificationBundle(),
            new Odiseo\Bundle\EcommerceBundle\OdiseoEcommerceBundle(),
        	new OdiseoCoreBundle(),
        	new Odiseo\Bundle\LokalBuddyBundle\OdiseoLokalBuddyBundle(),
		);

        if (in_array($this->environment, array('dev', 'test'))) {
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
        }

        return array_merge(parent::registerBundles(), $bundles);
    }
}
