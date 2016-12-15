<?php

namespace AppBundle\CityReport\RowParser;

class City implements RowParserInterface
{

    public function parse($row)
    {
        dump(['city' => str_replace('All MLS', '', $row)]);exit;
        return ['city' => str_replace('All MLS', '', $row)];
    }


}