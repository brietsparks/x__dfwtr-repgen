<?php

namespace AppBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;

class SubdivisionReportImportType extends ReportImportType
{

    protected $fileMimeTypes = [
        "application/json",
        "text/plain"
    ];

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('upload', FileType::class, [
                'label' => 'Json File or Zipped Json File\'s',
                'constraints' => new File([
                    'mimeTypes' => $this->getMimeTypes()
                ])
            ]);
    }

}