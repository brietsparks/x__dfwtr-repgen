<?php 

namespace AppBundle\CityReport;

use AppBundle\CityReport\RowParser\City;
use AppBundle\CityReport\RowParser\MonthYear;
use AppBundle\CityReport\RowParser\RowParserInterface;
use AppBundle\CityReport\RowParser\StatRowParser;
use AppBundle\CityReport\RowParser\AverageSalesPrice;
use AppBundle\CityReport\RowParser\ClosedSalesProjected;
use AppBundle\CityReport\RowParser\ClosedSalesReported;
use AppBundle\CityReport\RowParser\DaysOnMarket;
use AppBundle\CityReport\RowParser\Inventory;
use AppBundle\CityReport\RowParser\ListingsUnderContract;
use AppBundle\CityReport\RowParser\MedianSalesPrice;
use AppBundle\CityReport\RowParser\MonthsSupply;
use AppBundle\CityReport\RowParser\PercentOriginalListPrice;

/**
 * Takes a city report line/row and returns a DataPointParser if possible
 *
 * Class RowParserFactory
 * @package AppBundle\CityReportParser\Extractor
 */
class RowParserFactory
{

    /**
     * maps the beginning text of a line/row to the type of parser the row should receive
     * 
     * @var array
     */
    protected $map = [
//        'All MLS' => City::class,
//        'The CCAR Pulse' => MonthYear::class,
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
     * @return null|RowParserInterface
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