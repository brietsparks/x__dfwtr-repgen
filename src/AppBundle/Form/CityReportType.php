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
            ->add('newListings_monthPrev', null, ['label' => false,])
            ->add('salesReported_monthPrev', null, ['label' => false,])
            ->add('salesProjected_monthPrev', null, ['label' => false,])
            ->add('contractListings_monthPrev', null, ['label' => false,])
            ->add('avgPrice_monthPrev', null, ['label' => false,])
            ->add('medianPrice_monthPrev', null, ['label' => false,])
            ->add('percentReceived_monthPrev', null, ['label' => false,])
            ->add('daysOnMarket_monthPrev', null, ['label' => false,])
            ->add('inventory_monthPrev', null, ['label' => false,])
            ->add('monthsSupply_monthPrev', null, ['label' => false,])
            ->add('newListings_monthCurr', null, ['label' => false,])
            ->add('salesReported_monthCurr', null, ['label' => false,])
            ->add('salesProjected_monthCurr', null, ['label' => false,])
            ->add('contractListings_monthCurr', null, ['label' => false,])
            ->add('avgPrice_monthCurr', null, ['label' => false,])
            ->add('medianPrice_monthCurr', null, ['label' => false,])
            ->add('percentReceived_monthCurr', null, ['label' => false,])
            ->add('daysOnMarket_monthCurr', null, ['label' => false,])
            ->add('inventory_monthCurr', null, ['label' => false,])
            ->add('monthsSupply_monthCurr', null, ['label' => false,])
            ->add('newListings_monthChange', null, ['label' => false,])
            ->add('salesReported_monthChange', null, ['label' => false,])
            ->add('salesProjected_monthChange', null, ['label' => false,])
            ->add('contractListings_monthChange', null, ['label' => false,])
            ->add('avgPrice_monthChange', null, ['label' => false,])
            ->add('medianPrice_monthChange', null, ['label' => false,])
            ->add('percentReceived_monthChange', null, ['label' => false,])
            ->add('daysOnMarket_monthChange', null, ['label' => false,])
            ->add('inventory_monthChange', null, ['label' => false,])
            ->add('monthsSupply_monthChange', null, ['label' => false,])
            ->add('newListings_ytdPrev', null, ['label' => false,])
            ->add('salesReported_ytdPrev', null, ['label' => false,])
            ->add('salesProjected_ytdPrev', null, ['label' => false,])
            ->add('contractListings_ytdPrev', null, ['label' => false,])
            ->add('avgPrice_ytdPrev', null, ['label' => false,])
            ->add('medianPrice_ytdPrev', null, ['label' => false,])
            ->add('percentReceived_ytdPrev', null, ['label' => false,])
            ->add('daysOnMarket_ytdPrev', null, ['label' => false,])
//            ->add('inventory_ytdPrev', null, ['label' => false,])
//            ->add('monthsSupply_ytdPrev', null, ['label' => false,])
            ->add('newListings_ytdCurr', null, ['label' => false,])
            ->add('salesReported_ytdCurr', null, ['label' => false,])
            ->add('salesProjected_ytdCurr', null, ['label' => false,])
            ->add('contractListings_ytdCurr', null, ['label' => false,])
            ->add('avgPrice_ytdCurr', null, ['label' => false,])
            ->add('medianPrice_ytdCurr', null, ['label' => false,])
            ->add('percentReceived_ytdCurr', null, ['label' => false,])
            ->add('daysOnMarket_ytdCurr', null, ['label' => false,])
//            ->add('inventory_ytdCurr', null, ['label' => false,])
//            ->add('monthsSupply_ytdCurr', null, ['label' => false,])
            ->add('newListings_ytdChange', null, ['label' => false,])
            ->add('salesReported_ytdChange', null, ['label' => false,])
            ->add('salesProjected_ytdChange', null, ['label' => false,])
            ->add('contractListings_ytdChange', null, ['label' => false,])
            ->add('avgPrice_ytdChange', null, ['label' => false,])
            ->add('medianPrice_ytdChange', null, ['label' => false,])
            ->add('percentReceived_ytdChange', null, ['label' => false,])
            ->add('daysOnMarket_ytdChange', null, ['label' => false,])
//            ->add('inventory_ytdChange', null, ['label' => false,])
//            ->add('monthsSupply_ytdChange', null, ['label' => false,])
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
