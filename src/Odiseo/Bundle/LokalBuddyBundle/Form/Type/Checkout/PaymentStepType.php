<?php

namespace Odiseo\Bundle\LokalBuddyBundle\Form\Type\Checkout;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Sylius\Bundle\CoreBundle\Form\Type\Checkout\PaymentStepType as BasePaymentStepType;

/**
 * Checkout payment step form type.
 * This is a fix of Sylius. We need pass the data_class attribute to work. Check this in futher versions of Sylius.
 */
class PaymentStepType extends BasePaymentStepType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $notBlank = new NotBlank();
        $notBlank->message = 'sylius.checkout.payment_method.not_blank';

        $builder
            ->add('paymentMethod', 'sylius_payment_method_choice', array(
                'label'         => 'sylius.form.checkout.payment_method',
                'expanded'      => true,
                'property_path' => 'lastPayment.method',
            	'data_class'    => 'Sylius\Component\Payment\Model\PaymentMethod',
                'constraints'   => array(
                    $notBlank
                )
            ))
        ;
    }
}
