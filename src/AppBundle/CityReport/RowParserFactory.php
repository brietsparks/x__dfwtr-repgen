<?php 

namespace AppBundle\PdfScraper;

use AppBundle\PdfScraper\DataPointParser\AbstractDataPointParser;
use AppBundle\PdfScraper\DataPointParser\AverageSalesPrice;
use AppBundle\PdfScraper\DataPointParser\ClosedSalesProjected;
use AppBundle\PdfScraper\DataPointParser\ClosedSalesReported;
use AppBundle\PdfScraper\DataPointParser\DaysOnMarket;
use AppBundle\PdfScraper\DataPointParser\Inventory;
use AppBundle\PdfScraper\DataPointParser\ListingsUnderContract;
use AppBundle\PdfScraper\DataPointParser\MedianSalesPrice;
use AppBundle\PdfScraper\DataPointParser\MonthsSupply;
use AppBundle\PdfScraper\DataPointParser\PercentOriginalListPrice;

/**
 * Takes a city report row and returns a DataPointParser if possible
 *
 * Class DataPointParserFactory
 * @package AppBundle\PdfScraper\Extractor
 */
class DataPointParserFactory
{

    /**
     * maps a searchable string to the DataPointParser type
     * 
     * @var array
     */
    protected $map = [
        'Closed Sales (Reported)' => ClosedSalesReported::class,
        'Closed Sales (Projected)' => ClosedSalesProjected::class,
        'Listings Under Contract' => ListingsUnderContract::class,
        'Average Sales Price**' => AverageSalesPrice::class,
        'Median Sales Price**' => MedianSalesPrice::class,
        'Percent of Original List Price Received**' => PercentOriginalListPrice::class,
        'Days on Market Until Sale' => DaysOnMarket::class,
        'Inventory of Homes for Sale' => Inventory::class,
        'Months Supply of Inventory' => MonthsSupply::class,
    ];

    /**
     * @param string $row
     *
     * @return null|AbstractDataPointParser
     */
    public function getParser($row)
    {
        $result = null;

        foreach ($this->map as $searchFor => $class) {
            if(strpos($row, $searchFor) === 0) {
                return new $class;
            }
        }

        return $result;
    }
}