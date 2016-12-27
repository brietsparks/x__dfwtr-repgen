<?php

namespace AppBundle\SubdivisionReport;

use AppBundle\Services\ReportParserInterface;

class SubdivisionReportParser implements ReportParserInterface
{

    public function parse($text)
    {
        dump($text);exit;
    }


}