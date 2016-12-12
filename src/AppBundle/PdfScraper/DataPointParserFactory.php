<?php 

namespace AppBundle\PdfScraper\Extractor;

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
 * Extracts the stats from the pdf text 
 * 
 * Class StatRowExtractor
 * @package AppBundle\PdfScraper\Extractor
 */
class StatRowExtractor
{

    /**
     * maps search phrase to the stat type
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
     * @var array
     */
    protected $rows;

    /**
     * StatRowExtractor constructor.
     * @param array $rows
     */
    public function __construct($rows)
    {
        $this->rows = $rows;
    }
    
    public function extract()
    {
        
    }
}