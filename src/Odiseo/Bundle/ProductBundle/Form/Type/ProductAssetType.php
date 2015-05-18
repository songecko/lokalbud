<?php

namespace Odiseo\Bundle\ProductBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProductAssetType extends AbstractType
{	
	public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('file', 'file', array(
			'required' => false,
        	'label'    => 'Image'
        ));
    }
	
	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(array(
				'data_class' => 'Odiseo\Bundle\ProductBundle\Entity\ProductAsset',
      			'cascade_validation' => true,
		));
	}

    public function getName()
    {
        return 'odiseo_product_asset';
    }
}
