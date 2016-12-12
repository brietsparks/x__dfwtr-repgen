<?php namespace AppBundle\PdfScraper\DataPointParser;


class MedianSalesPrice extends AbstractDataPointParser
{

    protected $columnTitle = 'Median Sales Price**';

    protected $entityFieldPrefix = 'medianPrice';

}