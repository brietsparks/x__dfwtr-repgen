<?php 

namespace AppBundle\PdfScraper\Extractor;

use AppBundle\PdfScraper\Stat\AbstractDataPointParser;
use AppBundle\PdfScraper\Stat\AverageSalesPrice;
use AppBundle\PdfScraper\Stat\ClosedSalesProjected;
use AppBundle\PdfScraper\Stat\ClosedSalesReported;
use AppBundle\PdfScraper\Stat\DaysOnMarket;
use AppBundle\PdfScraper\Stat\Inventory;
use AppBundle\PdfScraper\Stat\ListingsUnderContract;
use AppBundle\PdfScraper\Stat\MedianSalesPrice;
use AppBundle\PdfScraper\Stat\MonthsSupply;
use AppBundle\PdfScraper\Stat\PercentOriginalListPrice;

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
        '(Reported)' => ClosedSalesReported::class,
        '(Projected)' => ClosedSalesProjected::class,
        'Listings Under' => ListingsUnderContract::class,
        'Average Sales' => AverageSalesPrice::class,
        'Median Sales' => MedianSalesPrice::class,
        'Percent of' => PercentOriginalListPrice::class,
        'Days on' => DaysOnMarket::class,
        'Inventory of' => Inventory::class,
        'Months Supply' => MonthsSupply::class,
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
            if(strpos($row, $searchFor) !== 0) {
                return new $class;
            }
        }

        return $result;
    }
}