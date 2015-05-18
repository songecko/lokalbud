<?php

namespace Odiseo\Bundle\ProductBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProductFormType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('title', 'text', array(
        		'required' => true,
        		'label'    => 'Title'
        ))
        ->add('description', 'text', array(
        		'required' => true,
        		'label'    => 'Description'
        ))
        ->add('shortDescription', 'text', array(
        		'required' => true,
        		'label'    => 'Short description'
        ))
        ->add('price', 'money', array(
        		'required' => true,
        		'currency' => 'USD',
        		'label'    => 'Price'
        ))
        ->add('quantity', 'text', array(
        		'required' => true,
        		'label'    => 'Quantity'
        ))
        ->add('latitud', 'number', array(
        		'required' => true,
        		'label'    => 'Latitud'
        ))
        ->add('longitud', 'number', array(
        		'required' => true,
        		'label'    => 'Longitud'
        ))
        ->add('address', 'text', array(
        		'required' => true,
        		'label'    => 'Address'
        ))
        ->add('town', 'entity', array(
			'class' => 'OdiseoEcommerceBundle:Town',
			'property' => 'name',
			'label'    => 'Town'
		))
        ->add('type', 'entity', array(
			'class' => 'OdiseoProductBundle:ProductType',
			'property' => 'description',
        	'label'    => 'Type'
		))
		->add('assets', 'collection', array(
			'type' => new ProductAssetType(),
			'allow_add' => true,
			'by_reference' => false,
			'label' => 'Images'
		))
        ->add('create', 'submit' , array('label' => 'Create'));
        //No se está mapeando. ->add('company', 'text', array('required' => true,'label' => 'Empresa', 'mapped' => false))
    }
	
	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(array(
				'data_class' => 'Odiseo\Bundle\ProductBundle\Entity\Product',
      			'cascade_validation' => true,
		));
	}

    public function getName()
    {
        return 'odiseo_product';
    }
}
