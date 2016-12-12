<?php namespace AppBundle\PdfScraper\DataPointParser;


class AverageSalesPrice extends AbstractDataPointParser
{

    protected $columnTitle = 'Average Sales Price**';

    protected $entityFieldPrefix = 'avgPrice';

}