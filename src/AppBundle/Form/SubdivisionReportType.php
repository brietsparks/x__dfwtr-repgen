<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SubdivisionReportType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('subdivision', EntityType::class, array(
                'class' => 'AppBundle\Entity\Subdivision',
                'choice_label' => 'name',
                'placeholder' => 'Please choose',
                'empty_data' => null,
                'required' => false
            ))
            ->add('start')
            ->add('end')
            ->add('sqft_min')
            ->add('sqft_max')
            ->add('sqft_avg')
            ->add('price_min')
            ->add('price_max')
            ->add('price_avg')
            ->add('pricePerSqft_min')
            ->add('pricePerSqft_max')
            ->add('pricePerSqft_avg')
            ->add('dom_min')
            ->add('dom_max')
            ->add('dom_avg')
            ->add('year_min')
            ->add('year_max')
            ->add('year_avg')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\SubdivisionReport'
        ));
    }
}
