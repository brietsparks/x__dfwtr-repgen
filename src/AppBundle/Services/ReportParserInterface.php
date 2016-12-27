<?php

namespace AppBundle\Services;

interface ReportParserInterface
{

    /**
     * Take text and return an array of entities
     *
     * @param string $text
     * @return array
     */
    public function parse($text);

}