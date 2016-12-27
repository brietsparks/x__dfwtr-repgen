<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;

class ReportImportType extends AbstractType
{

    protected $archiveMimeTypes = [
        "application/x-zip-compressed",
        "application/zip",
        "application/octet-stream",
        "application/x-rar-compressed",
        "application/x-rar",
    ];

    /**
     * The mime types of the type of file that is to be imported
     *
     * @var  array
     */
    protected $fileMimeTypes = [];

    protected function getMimeTypes()
    {
        return array_merge($this->archiveMimeTypes, $this->fileMimeTypes);
    }

}