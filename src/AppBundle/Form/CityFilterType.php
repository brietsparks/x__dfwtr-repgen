<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Lexik\Bundle\FormFilterBundle\Filter\Form\Type as Filters;


class CityFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id', Filters\NumberFilterType::class)
            ->add('mls', Filters\NumberFilterType::class)
            ->add('name', Filters\TextFilterType::class)
        
            ->add('reports', Filters\EntityFilterType::class, array(
                    'class' => 'AppBundle\Entity\CityReport',
                    'choice_label' => 'id',
            )) 
            ->add('subdivisions', Filters\EntityFilterType::class, array(
                    'class' => 'AppBundle\Entity\Subdivision',
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
