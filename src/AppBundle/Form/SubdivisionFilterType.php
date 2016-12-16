<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Lexik\Bundle\FormFilterBundle\Filter\Form\Type as Filters;


class SubdivisionFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id', Filters\NumberFilterType::class)
            ->add('name', Filters\TextFilterType::class)
        
            ->add('city', Filters\EntityFilterType::class, array(
                    'class' => 'AppBundle\Entity\City',
                    'choice_label' => 'name',
            )) 
            ->add('reports', Filters\EntityFilterType::class, array(
                    'class' => 'AppBundle\Entity\SubdivisionReport',
                    'choice_label' => 'id',
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
