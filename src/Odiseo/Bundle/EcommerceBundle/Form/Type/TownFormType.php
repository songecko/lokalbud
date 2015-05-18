<?php

namespace Odiseo\Bundle\EcommerceBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TownFormType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('name', 'text', array(
        		'required' => true,
        		'label'    => 'City'
        ));
    }
	
	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(array(
				'data_class' => 'Odiseo\Bundle\EcommerceBundle\Entity\Town',
      			'cascade_validation' => true,
		));
	}

    public function getName()
    {
        return 'odiseo_ecommerce_town';
    }
}
