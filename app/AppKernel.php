<?php

use Symfony\Component\Config\Loader\LoaderInterface;
use Odiseo\Bundle\ProjectBundle\Kernel\Kernel;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
			new JavierEguiluz\Bundle\EasyAdminBundle\EasyAdminBundle(),
            new Odiseo\Bundle\BackendBundle\OdiseoBackendBundle(),
        	new Knp\Bundle\GaufretteBundle\KnpGaufretteBundle(),
			new Vich\UploaderBundle\VichUploaderBundle(),
        	new Liip\ImagineBundle\LiipImagineBundle(),
        	new WhiteOctober\PagerfantaBundle\WhiteOctoberPagerfantaBundle(),
        	new Odiseo\Bundle\EcommerceBundle\OdiseoEcommerceBundle(),
        	new Odiseo\Bundle\UserBundle\OdiseoUserBundle(),
        	new Odiseo\Bundle\ProductBundle\OdiseoProductBundle(),
        	new Odiseo\Bundle\OrderBundle\OdiseoOrderBundle(),
        	new Odiseo\Bundle\LokalBuddyBundle\OdiseoLokalBuddyBundle()
		);

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            $bundles[] = new Symfony\Bundle\DebugBundle\DebugBundle();
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
        }
		
		return array_merge(parent::registerBundles(), $bundles);
	}
}
