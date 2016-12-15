<?php

namespace AppBundle\CityReport\RowParser;

interface RowParserInterface
{

    /**
     * Take a text string and return cleaned, parsed data
     *
     * @param string $row
     * @return array
     */
    public function parse($row);
}