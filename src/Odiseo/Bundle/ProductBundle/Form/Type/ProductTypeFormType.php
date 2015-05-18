<?php

namespace Odiseo\Bundle\ProductBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProductTypeFormType extends AbstractType
{

	
	public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('description', 'text', array(
        		'required' => true,
        		'label'    => 'Descripción'
        ));
    }
	
	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(array(
				'data_class' => 'Odiseo\Bundle\ProductBundle\Entity\ProductType',
      			'cascade_validation' => true,
		));
	}

    public function getName()
    {
        return 'odiseo_product_type';
    }
}
