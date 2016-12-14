<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;

class CityReportImportType extends AbstractType
{

    const ARCHIVE_MIME_TYPES = [
        "application/x-zip-compressed",
        "application/zip",
        "application/octet-stream",
        "application/x-rar-compressed",
        "application/x-rar",
    ];

    const PDF_MIME_TYPES = [
        "application/pdf",
        "application/x-pdf",
    ];

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('upload', FileType::class, [
                'label' => 'PDF or Zipped PDF\'s',
                'constraints' => new File([
                    'mimeTypes' => $this->getMimeTypes()
                ])
            ]);
    }

    protected function getMimeTypes()
    {
        return array_merge(self::ARCHIVE_MIME_TYPES, self::PDF_MIME_TYPES);
    }

}