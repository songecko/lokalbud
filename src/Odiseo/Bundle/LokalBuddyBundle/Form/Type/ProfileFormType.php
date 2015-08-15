<?php

namespace Odiseo\Bundle\LokalBuddyBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\AbstractType;
use Odiseo\Bundle\UserBundle\Form\Type\ProfileFormType as BaseProfileFormType;

class ProfileFormType extends BaseProfileFormType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    	parent::buildForm($builder, $options);
    	
        $builder
            ->add('paypalId', 'text', array(
            		'label' => 'odiseo.user.paypal',
            		'required' => true
            ))
            ->add('passportFile', 'file', array(
            	'label' => 'odiseo.user.passport',
            	'required' => true
            ))
        ;
    }
}