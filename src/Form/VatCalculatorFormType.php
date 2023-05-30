<?php

namespace App\Form;

use App\Entity\VatCalculationHistory;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class VatCalculatorFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('user_input_amount', IntegerType::class, [
                'attr' => array(
                    'class' => 'form-control input-sm mb-2',
                    'placeholder' => 'Enter Amount',
                    'min' => 1
                ),
                'label' => false,
                'required' => false
            ])
            ->add('vat_rate', IntegerType::class, [
                'attr' => array(
                    'class' => 'form-control input-sm mb-2',
                    'placeholder' => 'Enter Vat Rate',
                    'min' => 1,
                    'max' => 100
                ),
                'label' => false,
                'required' => false
            ])  
            ->add('vat_operation', ChoiceType::class, array(
                'attr' => array(
                    'class' => 'form-control mb-2'                    
                ), 
                'choices'  => array( 
                   'Add VAT' => 'add_vat', 
                   'Remove VAT' => 'remove_vat', 
                ), 
                'label' => false,
                'required' => true
            ))            
        ;
    }

    // public function configureOptions(OptionsResolver $resolver): void
    // {
    //     $resolver->setDefaults([
    //         'data_class' => VatCalculationHistory::class,
    //     ]);
    // }
}
