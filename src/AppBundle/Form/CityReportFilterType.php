<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Lexik\Bundle\FormFilterBundle\Filter\Form\Type as Filters;


class CityReportFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id', Filters\NumberFilterType::class)
            ->add('year', Filters\NumberFilterType::class)
            ->add('month', Filters\NumberFilterType::class)
            ->add('salesReported_monthPrev', Filters\NumberFilterType::class)
            ->add('salesProjected_monthPrev', Filters\NumberFilterType::class)
            ->add('contractListings_monthPrev', Filters\NumberFilterType::class)
            ->add('avgPrice_monthPrev', Filters\NumberFilterType::class)
            ->add('medianPrice_monthPrev', Filters\NumberFilterType::class)
            ->add('percentReceived_monthPrev', Filters\NumberFilterType::class)
            ->add('daysOnMarket_monthPrev', Filters\NumberFilterType::class)
            ->add('inventory_monthPrev', Filters\NumberFilterType::class)
            ->add('monthsSupply_monthPrev', Filters\NumberFilterType::class)
            ->add('salesReported_monthCurr', Filters\NumberFilterType::class)
            ->add('salesProjected_monthCurr', Filters\NumberFilterType::class)
            ->add('contractListings_monthCurr', Filters\NumberFilterType::class)
            ->add('avgPrice_monthCurr', Filters\NumberFilterType::class)
            ->add('medianPrice_monthCurr', Filters\NumberFilterType::class)
            ->add('percentReceived_monthCurr', Filters\NumberFilterType::class)
            ->add('daysOnMarket_monthCurr', Filters\NumberFilterType::class)
            ->add('inventory_monthCurr', Filters\NumberFilterType::class)
            ->add('monthsSupply_monthCurr', Filters\NumberFilterType::class)
            ->add('salesReported_monthChange', Filters\NumberFilterType::class)
            ->add('salesProjected_monthChange', Filters\NumberFilterType::class)
            ->add('contractListings_monthChange', Filters\NumberFilterType::class)
            ->add('avgPrice_monthChange', Filters\NumberFilterType::class)
            ->add('medianPrice_monthChange', Filters\NumberFilterType::class)
            ->add('percentReceived_monthChange', Filters\NumberFilterType::class)
            ->add('daysOnMarket_monthChange', Filters\NumberFilterType::class)
            ->add('inventory_monthChange', Filters\NumberFilterType::class)
            ->add('monthsSupply_monthChange', Filters\NumberFilterType::class)
            ->add('salesReported_ytdPrev', Filters\NumberFilterType::class)
            ->add('salesProjected_ytdPrev', Filters\NumberFilterType::class)
            ->add('contractListings_ytdPrev', Filters\NumberFilterType::class)
            ->add('avgPrice_ytdPrev', Filters\NumberFilterType::class)
            ->add('medianPrice_ytdPrev', Filters\NumberFilterType::class)
            ->add('percentReceived_ytdPrev', Filters\NumberFilterType::class)
            ->add('daysOnMarket_ytdPrev', Filters\NumberFilterType::class)
            ->add('inventory_ytdPrev', Filters\NumberFilterType::class)
            ->add('monthsSupply_ytdPrev', Filters\NumberFilterType::class)
            ->add('salesReported_ytdCurr', Filters\NumberFilterType::class)
            ->add('salesProjected_ytdCurr', Filters\NumberFilterType::class)
            ->add('contractListings_ytdCurr', Filters\NumberFilterType::class)
            ->add('avgPrice_ytdCurr', Filters\NumberFilterType::class)
            ->add('medianPrice_ytdCurr', Filters\NumberFilterType::class)
            ->add('percentReceived_ytdCurr', Filters\NumberFilterType::class)
            ->add('daysOnMarket_ytdCurr', Filters\NumberFilterType::class)
            ->add('inventory_ytdCurr', Filters\NumberFilterType::class)
            ->add('monthsSupply_ytdCurr', Filters\NumberFilterType::class)
            ->add('salesReported_ytdChange', Filters\NumberFilterType::class)
            ->add('salesProjected_ytdChange', Filters\NumberFilterType::class)
            ->add('contractListings_ytdChange', Filters\NumberFilterType::class)
            ->add('avgPrice_ytdChange', Filters\NumberFilterType::class)
            ->add('medianPrice_ytdChange', Filters\NumberFilterType::class)
            ->add('percentReceived_ytdChange', Filters\NumberFilterType::class)
            ->add('daysOnMarket_ytdChange', Filters\NumberFilterType::class)
            ->add('inventory_ytdChange', Filters\NumberFilterType::class)
            ->add('monthsSupply_ytdChange', Filters\NumberFilterType::class)
        
            ->add('city', Filters\EntityFilterType::class, array(
                    'class' => 'AppBundle\Entity\City',
                    'choice_label' => 'name',
            )) 
        ;
        $builder->setMethod("GET");


    }

    public function getBlockPrefix()
    {
        return null;
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'allow_extra_fields' => true,
            'csrf_protection' => false,
            'validation_groups' => array('filtering') // avoid NotBlank() constraint-related message
        ));
    }
}
