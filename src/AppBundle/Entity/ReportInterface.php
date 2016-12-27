<?php

namespace AppBundle\Entity;

interface ReportInterface
{

    /**
     * @return array
     */
    public function getMissingDataFields();

}