<?php

namespace AppBundle\CityReport\RowParser;

class MonthYear implements RowParserInterface
{

    public function parse($row)
    {
        $dateYear = str_replace('The CCAR Pulse – ','', $row);

        $arr = explode(' ', $dateYear);

        $month = date_parse($arr[0])['month'];
        $year = $arr[1];

        return [
            'month' => $month,
            'year' => $year
        ];
    }


}