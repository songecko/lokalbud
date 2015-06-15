<?php

namespace Odiseo\Bundle\LokalBuddyBundle\Menu;

use Knp\Menu\ItemInterface;
use Sylius\Bundle\WebBundle\Event\MenuBuilderEvent;
use Sylius\Bundle\WebBundle\Menu\BackendMenuBuilder as BaseBackendMenuBuilder;

/**
 * Main menu builder.
 *
 * @author Paweł Jędrzejewski <pawel@sylius.org>
 */
class BackendMenuBuilder extends BaseBackendMenuBuilder
{
    /**
     * Builds backend sidebar menu.
     *
     * @return ItemInterface
     */
    public function createSidebarMenu()
    {
        $menu = $this->factory->createItem('root', array(
            'childrenAttributes' => array(
                'class' => 'sidebar-menu'
            )
        ));

        $menu->setCurrentUri($this->request->getRequestUri());

        $childOptions = array(
        	'uri' => '#',
        	'attributes'         => array('class' => 'treeview'),
            'childrenAttributes' => array('class' => 'treeview-menu'),
            'labelAttributes'    => array('class' => 'nav-header')
        );

        $this->addAssortmentMenu($menu, $childOptions, 'sidebar');
        $this->addSalesMenu($menu, $childOptions, 'sidebar');
        //$this->addMarketingMenu($menu, $childOptions, 'sidebar');
        $this->addCustomersMenu($menu, $childOptions, 'sidebar');
        //$this->addSupportMenu($menu, $childOptions, 'sidebar');
        //$this->addContentMenu($menu, $childOptions, 'sidebar');
        $this->addConfigurationMenu($menu, $childOptions, 'sidebar');

        $this->eventDispatcher->dispatch(MenuBuilderEvent::BACKEND_SIDEBAR, new MenuBuilderEvent($this->factory, $menu));

        return $menu;
    }
    
    protected function addAssortmentMenu(ItemInterface $menu, array $childOptions, $section)
    {
    	$child = $menu
    	->addChild('assortment', $childOptions)
    	->setLabel($this->translate(sprintf('sylius.backend.menu.%s.assortment', $section)))
    	;
    
    	if ($this->authorizationChecker->isGranted('sylius.taxonomy.index')) {
    		$child->addChild('taxonomies', array(
    				'route' => 'sylius_backend_taxonomy_index',
    				'labelAttributes' => array('icon' => 'glyphicon glyphicon-folder-close'),
    		))->setLabel($this->translate(sprintf('sylius.backend.menu.%s.taxonomies', $section)));
    	}
    
    	if ($this->authorizationChecker->isGranted('sylius.product.index')) {
    		$child->addChild('products', array(
    				'route' => 'sylius_backend_product_index',
    				'labelAttributes' => array('icon' => 'glyphicon glyphicon-th-list'),
    		))->setLabel($this->translate(sprintf('sylius.backend.menu.%s.products', $section)));
    		/*$child->addChild('inventory', array(
    				'route' => 'sylius_backend_inventory_index',
    				'labelAttributes' => array('icon' => 'glyphicon glyphicon-tasks'),
    		))->setLabel($this->translate(sprintf('sylius.backend.menu.%s.stockables', $section)));*/
    	}
    
    	/*if ($this->authorizationChecker->isGranted('sylius.product_option.index')) {
    		$child->addChild('options', array(
    				'route' => 'sylius_backend_product_option_index',
    				'labelAttributes' => array('icon' => 'glyphicon glyphicon-th'),
    		))->setLabel($this->translate(sprintf('sylius.backend.menu.%s.options', $section)));
    	}
    
    	if ($this->authorizationChecker->isGranted('sylius.product_attribute.index')) {
    		$child->addChild('product_attributes', array(
    				'route' => 'sylius_backend_product_attribute_index',
    				'labelAttributes' => array('icon' => 'glyphicon glyphicon-list-alt'),
    		))->setLabel($this->translate(sprintf('sylius.backend.menu.%s.attributes', $section)));
    	}
    
    	if ($this->authorizationChecker->isGranted('sylius.product_archetype.index')) {
    		$child->addChild('product_archetypes', array(
    				'route' => 'sylius_backend_product_archetype_index',
    				'labelAttributes' => array('icon' => 'glyphicon glyphicon-compressed'),
    		))->setLabel($this->translate(sprintf('sylius.backend.menu.%s.archetypes', $section)));
    	}*/
    
    	if (!$child->hasChildren()) {
    		$menu->removeChild('assortment');
    	}
    }
    
    protected function addSalesMenu(ItemInterface $menu, array $childOptions, $section)
    {
    	$child = $menu
    	->addChild('sales', $childOptions)
    	->setLabel($this->translate(sprintf('sylius.backend.menu.%s.sales', $section)))
    	;
    
    	if ($this->authorizationChecker->isGranted('sylius.order.index')) {
    		$child->addChild('orders', array(
    				'route' => 'sylius_backend_order_index',
    				'labelAttributes' => array('icon' => 'glyphicon glyphicon-shopping-cart'),
    		))->setLabel($this->translate(sprintf('sylius.backend.menu.%s.orders', $section)));
    	}
    	/*if ($this->authorizationChecker->isGranted('sylius.shipment.index')) {
    		$child->addChild('shipments', array(
    				'route' => 'sylius_backend_shipment_index',
    				'labelAttributes' => array('icon' => 'glyphicon glyphicon-plane'),
    		))->setLabel($this->translate(sprintf('sylius.backend.menu.%s.shipments', $section)));
    	}
    	if ($this->authorizationChecker->isGranted('sylius.payment.index')) {
    		$child->addChild('payments', array(
    				'route' => 'sylius_backend_payment_index',
    				'labelAttributes' => array('icon' => 'glyphicon glyphicon-credit-card'),
    		))->setLabel($this->translate(sprintf('sylius.backend.menu.%s.payments', $section)));
    	}
    	if ($this->authorizationChecker->isGranted('sylius.report.index')) {
    		$child->addChild('reports', array(
    				'route' => 'sylius_backend_report_index',
    				'labelAttributes' => array('icon' => 'glyphicon glyphicon-stats'),
    		))->setLabel($this->translate(sprintf('sylius.backend.menu.%s.report', $section)));
    	}*/
    
    	if (!$child->hasChildren()) {
    		$menu->removeChild('sales');
    	}
    }
    
    protected function addConfigurationMenu(ItemInterface $menu, array $childOptions, $section)
    {
    	$child = $menu
    	->addChild('configuration', $childOptions)
    	->setLabel($this->translate(sprintf('sylius.backend.menu.%s.configuration', $section)))
    	;
    
    	if ($this->authorizationChecker->isGranted('sylius.settings.general')) {
    		$child->addChild('general_settings', array(
    				'route'           => 'sylius_backend_general_settings',
    				'labelAttributes' => array('icon' => 'glyphicon glyphicon-info-sign'),
    		))->setLabel($this->translate(sprintf('sylius.backend.menu.%s.general_settings', $section)));
    	}
    
    	/*if ($this->authorizationChecker->isGranted('sylius.settings.security')) {
    		$child->addChild('security_settings', array(
    				'route'           => 'sylius_backend_security_settings',
    				'labelAttributes' => array('icon' => 'glyphicon glyphicon-lock'),
    		))->setLabel($this->translate(sprintf('sylius.backend.menu.%s.security_settings', $section)));
    	}
    
    	if ($this->authorizationChecker->isGranted('sylius.locale.index')) {
    		$child->addChild('locales', array(
    				'route' => 'sylius_backend_locale_index',
    				'labelAttributes' => array('icon' => 'glyphicon glyphicon-flag'),
    		))->setLabel($this->translate(sprintf('sylius.backend.menu.%s.locales', $section)));
    	}
    
    	if ($this->authorizationChecker->isGranted('sylius.payment_method.index')) {
    		$child->addChild('payment_methods', array(
    				'route' => 'sylius_backend_payment_method_index',
    				'labelAttributes' => array('icon' => 'glyphicon glyphicon-credit-card'),
    		))->setLabel($this->translate(sprintf('sylius.backend.menu.%s.payment_methods', $section)));
    	}
    
    	if ($this->authorizationChecker->isGranted('sylius.currency.index')) {
    		$child->addChild('currencies', array(
    				'route' => 'sylius_backend_currency_index',
    				'labelAttributes' => array('icon' => 'glyphicon glyphicon-usd'),
    		))->setLabel($this->translate(sprintf('sylius.backend.menu.%s.currencies', $section)));
    	}
    
    	if ($this->authorizationChecker->isGranted('sylius.settings.taxation')) {
    		$child->addChild('taxation_settings', array(
    				'route'           => 'sylius_backend_taxation_settings',
    				'labelAttributes' => array('icon' => 'glyphicon glyphicon-cog'),
    		))->setLabel($this->translate(sprintf('sylius.backend.menu.%s.taxation_settings', $section)));
    	}
    
    	if ($this->authorizationChecker->isGranted('sylius.tax_category.index')) {
    		$child->addChild('tax_categories', array(
    				'route' => 'sylius_backend_tax_category_index',
    				'labelAttributes' => array('icon' => 'glyphicon glyphicon-cog'),
    		))->setLabel($this->translate(sprintf('sylius.backend.menu.%s.tax_categories', $section)));
    	}
    
    	if ($this->authorizationChecker->isGranted('sylius.tax_rate.index')) {
    		$child->addChild('tax_rates', array(
    				'route' => 'sylius_backend_tax_rate_index',
    				'labelAttributes' => array('icon' => 'glyphicon glyphicon-cog'),
    		))->setLabel($this->translate(sprintf('sylius.backend.menu.%s.tax_rates', $section)));
    	}
    
    	if ($this->authorizationChecker->isGranted('sylius.shipping_category.index')) {
    		$child->addChild('shipping_categories', array(
    				'route' => 'sylius_backend_shipping_category_index',
    				'labelAttributes' => array('icon' => 'glyphicon glyphicon-cog'),
    		))->setLabel($this->translate(sprintf('sylius.backend.menu.%s.shipping_categories', $section)));
    	}
    
    	if ($this->authorizationChecker->isGranted('sylius.shipping_method.index')) {
    		$child->addChild('shipping_methods', array(
    				'route' => 'sylius_backend_shipping_method_index',
    				'labelAttributes' => array('icon' => 'glyphicon glyphicon-cog'),
    		))->setLabel($this->translate(sprintf('sylius.backend.menu.%s.shipping_methods', $section)));
    	}
    
    	if ($this->authorizationChecker->isGranted('sylius.country.index')) {
    		$child->addChild('countries', array(
    				'route' => 'sylius_backend_country_index',
    				'labelAttributes' => array('icon' => 'glyphicon glyphicon-flag'),
    		))->setLabel($this->translate(sprintf('sylius.backend.menu.%s.countries', $section)));
    	}
    
    	if ($this->authorizationChecker->isGranted('sylius.zone.index')) {
    		$child->addChild('zones', array(
    				'route' => 'sylius_backend_zone_index',
    				'labelAttributes' => array('icon' => 'glyphicon glyphicon-globe'),
    		))->setLabel($this->translate(sprintf('sylius.backend.menu.%s.zones', $section)));
    	}
    
    	if ($this->authorizationChecker->isGranted('sylius.api_client.index')) {
    		$child->addChild('api_clients', array(
    				'route' => 'sylius_backend_api_client_index',
    				'labelAttributes' => array('icon' => 'glyphicon glyphicon-globe'),
    		))->setLabel($this->translate(sprintf('sylius.backend.menu.%s.api_clients', $section)));
    	}*/
    
    	if (!$child->hasChildren()) {
    		$menu->removeChild('configuration');
    	}
    }
}
