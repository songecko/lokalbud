<?php

namespace Odiseo\Bundle\LokalBuddyBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Odiseo\Bundle\ProductBundle\Form\Type\ProductFormType as BaseProductFormType;

class ProductLokalFormType extends BaseProductFormType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    	parent::buildForm($builder, $options);

    	$values = array(1 => '1',2 => '2',3 => '3',4 => '4',5 => '5',6 => '6',7 => '7');
        $builder
            ->add('maxQuantity', 'choice', array(
            		'label' => 'odiseo.lokalbuddy.form.maxQuantity',
    				'choices' => $values,            		
            		'required' => true
            ))
        ;
    }
}