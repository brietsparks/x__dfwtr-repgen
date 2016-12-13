<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CityReportType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('city', EntityType::class, array(
                'class' => 'AppBundle\Entity\City',
                'choice_label' => 'name',
                'placeholder' => 'Please choose',
                'empty_data' => null,
                'required' => false
            ))
            ->add('year')
            ->add('month')
            ->add('salesReported_monthPrev')
            ->add('salesProjected_monthPrev')
            ->add('contractListings_monthPrev')
            ->add('avgPrice_monthPrev')
            ->add('medianPrice_monthPrev')
            ->add('percentReceived_monthPrev')
            ->add('daysOnMarket_monthPrev')
            ->add('inventory_monthPrev')
            ->add('monthsSupply_monthPrev')
            ->add('salesReported_monthCurr')
            ->add('salesProjected_monthCurr')
            ->add('contractListings_monthCurr')
            ->add('avgPrice_monthCurr')
            ->add('medianPrice_monthCurr')
            ->add('percentReceived_monthCurr')
            ->add('daysOnMarket_monthCurr')
            ->add('inventory_monthCurr')
            ->add('monthsSupply_monthCurr')
            ->add('salesReported_monthChange')
            ->add('salesProjected_monthChange')
            ->add('contractListings_monthChange')
            ->add('avgPrice_monthChange')
            ->add('medianPrice_monthChange')
            ->add('percentReceived_monthChange')
            ->add('daysOnMarket_monthChange')
            ->add('inventory_monthChange')
            ->add('monthsSupply_monthChange')
            ->add('salesReported_ytdPrev')
            ->add('salesProjected_ytdPrev')
            ->add('contractListings_ytdPrev')
            ->add('avgPrice_ytdPrev')
            ->add('medianPrice_ytdPrev')
            ->add('percentReceived_ytdPrev')
            ->add('daysOnMarket_ytdPrev')
            ->add('inventory_ytdPrev')
            ->add('monthsSupply_ytdPrev')
            ->add('salesReported_ytdCurr')
            ->add('salesProjected_ytdCurr')
            ->add('contractListings_ytdCurr')
            ->add('avgPrice_ytdCurr')
            ->add('medianPrice_ytdCurr')
            ->add('percentReceived_ytdCurr')
            ->add('daysOnMarket_ytdCurr')
            ->add('inventory_ytdCurr')
            ->add('monthsSupply_ytdCurr')
            ->add('salesReported_ytdChange')
            ->add('salesProjected_ytdChange')
            ->add('contractListings_ytdChange')
            ->add('avgPrice_ytdChange')
            ->add('medianPrice_ytdChange')
            ->add('percentReceived_ytdChange')
            ->add('daysOnMarket_ytdChange')
            ->add('inventory_ytdChange')
            ->add('monthsSupply_ytdChange')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\CityReport'
        ));
    }
}
