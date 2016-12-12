<?php namespace AppBundle\PdfScraper\DataPointParser;


class PercentOriginalListPrice extends AbstractDataPointParser
{

    protected $columnTitle = 'Percent of Original List Price Received**';

    protected $entityFieldPrefix = 'percentReceived';

}