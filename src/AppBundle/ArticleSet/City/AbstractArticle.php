<?php namespace AppBundle\ArticleSet\City;


use AppBundle\Entity\City;
use AppBundle\Entity\CityReport;
use AppBundle\Spinner\Spinner;

abstract class AbstractArticle
{
    // might need to inject map from city name to url for each article

    /**
     * @var Spinner
     */
    protected $spinner;

    /**
     * AbstractArticle constructor.
     * @param Spinner $spinner
     */
    public function __construct(Spinner $spinner)
    {
        $this->spinner = $spinner;
    }


    /**
     * @param CityReport $cityReport
     * @return string
     */
    public function generate(CityReport$cityReport)
    {
        $table = $this->getTable($cityReport);
        $main = $this->spinner->spin($cityReport);
        $footer = $this->getFooter(
            $cityReport->getCity()->getName(),
            $cityReport->year,
            $cityReport->month
        );

        return (
            $table . "\r\n" .
            $main['title'] . "\r\n" . "\r\n" .
            $main['body'] . "\r\n" .
            $footer
        );
    }

    /**
     * @param string $cityName
     * @param int $reportYear
     * @param int $reportMonthNumber
     *
     * @return string
     */
    abstract public function getFooter($cityName, $reportYear, $reportMonthNumber);

    /**
     * @param $monthNum
     * @return string
     */
    protected function getMonthName($monthNum)
    {
        $dateObj = \DateTime::createFromFormat('!m', $monthNum);
        $monthName = $dateObj->format('F'); // March

        return $monthName;
    }

    protected function getLcCityName($cityName)
    {
        $lcCityName = strtolower($cityName);
        $lcCityName = str_replace(" ", "-", $lcCityName);

        return $lcCityName;
    }

    /**
     * @param $monthNum
     * @return string
     */
    protected function getLcMonthNamce($monthNum)
    {
        return strtolower($this->getMonthName($monthNum));
    }

    /**
     * @return string
     */
    protected function getThisYear()
    {
        return date("Y");
    }

    /**
     * @return string
     */
    protected function getThisMonth()
    {
        return date('m');
    }

    /**
     * @param CityReport $cityReport
     *
     * @return string
     */
    public function getTable(CityReport $cityReport)
    {
        $month = $cityReport->month;
        $year = $cityReport->year;
        $lastYear = $year - 1;

        $monthName = $this->getMonthName($month);

        /** @var City $city */
        $city = $cityReport->getCity();

        $cityName = $city->getName();
        $mls = $city->getMls();

        $text = "
            <table border='1' style='border-collapse: collapse;'>
                <caption>$monthName $year Real Estate Market Summary for $cityName, TX (MLS Area $mls)</caption>
                <tr>
                <th></th>
                <th colspan='3'>Month</th>
                <th colspan='3'>Year to Date</th>
                </tr>
                <tr>
                <th></th>
                <th>$lastYear</th>
                <th>$year</th>
                <th>% Change</th>
                <th>$lastYear</th>
                <th>$year</th>
                <th>% Change</th>
                </tr>
                <tr>
                    <th align='left'>Closed Sales (Reported)</th>
                    <td style='min-width: 70px'>{$cityReport->salesReported_monthPrev}</td>
                    <td style='min-width: 70px'>{$cityReport->salesReported_monthCurr}</td>
                    <td style='min-width: 70px'>{$cityReport->salesReported_monthChange}</td>
                    <td style='min-width: 70px'>{$cityReport->salesReported_ytdPrev}</td>
                    <td style='min-width: 70px'>{$cityReport->salesReported_ytdCurr}</td>
                    <td style='min-width: 70px'>{$cityReport->salesReported_ytdChange}</td>
                </tr><tr>
                    <th align='left'>Closed Sales (Projected)</th>
                    <td style='min-width: 70px'>{$cityReport->salesProjected_monthPrev}</td>
                    <td style='min-width: 70px'>{$cityReport->salesProjected_monthCurr}</td>
                    <td style='min-width: 70px'>{$cityReport->salesProjected_monthChange}</td>
                    <td style='min-width: 70px'>{$cityReport->salesProjected_ytdPrev}</td>
                    <td style='min-width: 70px'>{$cityReport->salesProjected_ytdCurr}</td>
                    <td style='min-width: 70px'>{$cityReport->salesProjected_ytdChange}</td>
                </tr><tr>
                    <th align='left'>Listings Under Contract</th>
                    <td style='min-width: 70px'>{$cityReport->contractListings_monthPrev}</td>
                    <td style='min-width: 70px'>{$cityReport->contractListings_monthCurr}</td>
                    <td style='min-width: 70px'>{$cityReport->contractListings_monthChange}</td>
                    <td style='min-width: 70px'>{$cityReport->contractListings_ytdPrev}</td>
                    <td style='min-width: 70px'>{$cityReport->contractListings_ytdCurr}</td>
                    <td style='min-width: 70px'>{$cityReport->contractListings_ytdChange}</td>
                </tr><tr>
                    <th align='left'>Average Sales Price</th>
                    <td style='min-width: 70px'>\${$cityReport->avgPrice_monthPrev}</td>
                    <td style='min-width: 70px'>\${$cityReport->avgPrice_monthCurr}</td>
                    <td style='min-width: 70px'>{$cityReport->avgPrice_monthChange}</td>
                    <td style='min-width: 70px'>\${$cityReport->avgPrice_ytdPrev}</td>
                    <td style='min-width: 70px'>\${$cityReport->avgPrice_ytdCurr}</td>
                    <td style='min-width: 70px'>{$cityReport->avgPrice_ytdChange}</td>
                </tr><tr>
                    <th align='left'>Median Sales Price</th>
                    <td style='min-width: 70px'>\${$cityReport->medianPrice_monthPrev}</td>
                    <td style='min-width: 70px'>\${$cityReport->medianPrice_monthCurr}</td>
                    <td style='min-width: 70px'>{$cityReport->medianPrice_monthChange}</td>
                    <td style='min-width: 70px'>\${$cityReport->medianPrice_ytdPrev}</td>
                    <td style='min-width: 70px'>\${$cityReport->medianPrice_ytdCurr}</td>
                    <td style='min-width: 70px'>{$cityReport->medianPrice_ytdChange}</td>
                </tr><tr>
                    <th align='left'>Percent of Original Price Received</th>
                    <td style='min-width: 70px'>{$cityReport->percentReceived_monthPrev}</td>
                    <td style='min-width: 70px'>{$cityReport->percentReceived_monthCurr}</td>
                    <td style='min-width: 70px'>{$cityReport->percentReceived_monthChange}</td>
                    <td style='min-width: 70px'>{$cityReport->percentReceived_ytdPrev}</td>
                    <td style='min-width: 70px'>{$cityReport->percentReceived_ytdCurr}</td>
                    <td style='min-width: 70px'>{$cityReport->percentReceived_ytdChange}</td>
                </tr><tr>
                    <th align='left'>Days on Market Until Sale</th>
                    <td style='min-width: 70px'>{$cityReport->daysOnMarket_monthPrev}</td>
                    <td style='min-width: 70px'>{$cityReport->daysOnMarket_monthCurr}</td>
                    <td style='min-width: 70px'>{$cityReport->daysOnMarket_monthChange}</td>
                    <td style='min-width: 70px'>{$cityReport->daysOnMarket_ytdPrev}</td>
                    <td style='min-width: 70px'>{$cityReport->daysOnMarket_ytdCurr}</td>
                    <td style='min-width: 70px'>{$cityReport->daysOnMarket_ytdChange}</td>
                </tr><tr>
                    <th align='left'>Inventory of Homes for Sale</th>
                    <td style='min-width: 70px'>{$cityReport->inventory_monthPrev}</td>
                    <td style='min-width: 70px'>{$cityReport->inventory_monthCurr}</td>
                    <td style='min-width: 70px'>{$cityReport->inventory_monthChange}</td>
                    <td style='min-width: 70px'></td>
                    <td style='min-width: 70px'></td>
                    <td style='min-width: 70px'></td>
                </tr><tr>
                    <th align='left'>Months Supply of Inventory</th>
                    <td style='min-width: 70px'>{$cityReport->monthsSupply_monthPrev}</td>
                    <td style='min-width: 70px'>{$cityReport->monthsSupply_monthCurr}</td>
                    <td style='min-width: 70px'>{$cityReport->monthsSupply_monthChange}</td>
                    <td style='min-width: 70px'></td>
                    <td style='min-width: 70px'></td>
                    <td style='min-width: 70px'></td>
                </tr>
            </table>
        ";

        return $text;
    }

}