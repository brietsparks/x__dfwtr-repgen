<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="city_report")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CityReportRepository")
 */
class CityReport
{

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=true)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\City", inversedBy="reports")
     * @ORM\JoinColumn(name="city_id", referencedColumnName="id")
     */
    public $city;

    /**
     * @var int
     *
     * @ORM\Column(name="year", type="integer")
     */
    public $year;

    /**
     * @var int
     *
     * @ORM\Column(name="month", type="integer")
     */
    public $month;


    /**
     * @return array
     */
    public function getDataPoints()
    {
        $props = get_object_vars($this);

        unset($props['id']);

        return $props;
    }

    /**
     * @return bool
     */
    public function hasMissingData()
    {
        return in_array(null, $this->getDataPoints(), true);
    }

    /**
     * @return bool
     */
    public function isMissingData()
    {
        return $this->hasMissingData();
    }

    /**
     * @return array
     */
    public function getMissingDataFields()
    {
        return array_filter($this->getDataPoints(), function ($dataPoint) {
            return $dataPoint === null;
        });
    }

    /**
     * @var int
     *
     * @ORM\Column(name="newListings_monthPrev", type="integer", nullable=true)
     */
    public $newListings_monthPrev;

    /**
     * @var int
     *
     * @ORM\Column(name="salesReported_monthPrev", type="integer", nullable=true)
     */
    public $salesReported_monthPrev;

    /**
     * @var int
     *
     * @ORM\Column(name="salesProjected_monthPrev", type="integer", nullable=true)
     */
    public $salesProjected_monthPrev;

    /**
     * @var int
     *
     * @ORM\Column(name="contractListings_monthPrev", type="integer", nullable=true)
     */
    public $contractListings_monthPrev;

    /**
     * @var int
     *
     * @ORM\Column(name="avgPrice_monthPrev", type="integer", nullable=true)
     */
    public $avgPrice_monthPrev;

    /**
     * @var int
     *
     * @ORM\Column(name="medianPrice_monthPrev", type="integer", nullable=true)
     */
    public $medianPrice_monthPrev;

    /**
     * @var float
     *
     * @ORM\Column(name="percentReceived_monthPrev", type="float", nullable=true)
     */
    public $percentReceived_monthPrev;

    /**
     * @var float
     *
     * @ORM\Column(name="daysOnMarket_monthPrev", type="float", nullable=true)
     */
    public $daysOnMarket_monthPrev;

    /**
     * @var int
     *
     * @ORM\Column(name="inventory_monthPrev", type="integer", nullable=true)
     */
    public $inventory_monthPrev;

    /**
     * @var int
     *
     * @ORM\Column(name="monthsSupply_monthPrev", type="integer", nullable=true)
     */
    public $monthsSupply_monthPrev;

    /**
     * @var int
     *
     * @ORM\Column(name="newListings_monthCurr", type="integer", nullable=true)
     */
    public $newListings_monthCurr;

    /**
     * @var int
     *
     * @ORM\Column(name="salesReported_monthCurr", type="integer", nullable=true)
     */
    public $salesReported_monthCurr;

    /**
     * @var int
     *
     * @ORM\Column(name="salesProjected_monthCurr", type="integer", nullable=true)
     */
    public $salesProjected_monthCurr;

    /**
     * @var int
     *
     * @ORM\Column(name="contractListings_monthCurr", type="integer", nullable=true)
     */
    public $contractListings_monthCurr;

    /**
     * @var int
     *
     * @ORM\Column(name="avgPrice_monthCurr", type="integer", nullable=true)
     */
    public $avgPrice_monthCurr;

    /**
     * @var int
     *
     * @ORM\Column(name="medianPrice_monthCurr", type="integer", nullable=true)
     */
    public $medianPrice_monthCurr;

    /**
     * @var float
     *
     * @ORM\Column(name="percentReceived_monthCurr", type="float", nullable=true)
     */
    public $percentReceived_monthCurr;

    /**
     * @var float
     *
     * @ORM\Column(name="daysOnMarket_monthCurr", type="float", nullable=true)
     */
    public $daysOnMarket_monthCurr;

    /**
     * @var int
     *
     * @ORM\Column(name="inventory_monthCurr", type="integer", nullable=true)
     */
    public $inventory_monthCurr;

    /**
     * @var int
     *
     * @ORM\Column(name="monthsSupply_monthCurr", type="integer", nullable=true)
     */
    public $monthsSupply_monthCurr;


    /**
     * @var float
     *
     * @ORM\Column(name="newListings_monthChange", type="float", nullable=true)
     */
    public $newListings_monthChange;

    /**
     * @var float
     *
     * @ORM\Column(name="salesReported_monthChange", type="float", nullable=true)
     */
    public $salesReported_monthChange;

    /**
     * @var float
     *
     * @ORM\Column(name="salesProjected_monthChange", type="float", nullable=true)
     */
    public $salesProjected_monthChange;

    /**
     * @var float
     *
     * @ORM\Column(name="contractListings_monthChange", type="float", nullable=true)
     */
    public $contractListings_monthChange;

    /**
     * @var float
     *
     * @ORM\Column(name="avgPrice_monthChange", type="float", nullable=true)
     */
    public $avgPrice_monthChange;

    /**
     * @var float
     *
     * @ORM\Column(name="medianPrice_monthChange", type="float", nullable=true)
     */
    public $medianPrice_monthChange;

    /**
     * @var float
     *
     * @ORM\Column(name="percentReceived_monthChange", type="float", nullable=true)
     */
    public $percentReceived_monthChange;

    /**
     * @var float
     *
     * @ORM\Column(name="daysOnMarket_monthChange", type="float", nullable=true)
     */
    public $daysOnMarket_monthChange;

    /**
     * @var float
     *
     * @ORM\Column(name="inventory_monthChange", type="float", nullable=true)
     */
    public $inventory_monthChange;

    /**
     * @var float
     *
     * @ORM\Column(name="monthsSupply_monthChange", type="float", nullable=true)
     */
    public $monthsSupply_monthChange;


    /**
     * @var int
     *
     * @ORM\Column(name="newListings_ytdPrev", type="integer", nullable=true)
     */
    public $newListings_ytdPrev;

    /**
     * @var int
     *
     * @ORM\Column(name="salesReported_ytdPrev", type="integer", nullable=true)
     */
    public $salesReported_ytdPrev;

    /**
     * @var int
     *
     * @ORM\Column(name="salesProjected_ytdPrev", type="integer", nullable=true)
     */
    public $salesProjected_ytdPrev;

    /**
     * @var int
     *
     * @ORM\Column(name="contractListings_ytdPrev", type="integer", nullable=true)
     */
    public $contractListings_ytdPrev;

    /**
     * @var int
     *
     * @ORM\Column(name="avgPrice_ytdPrev", type="integer", nullable=true)
     */
    public $avgPrice_ytdPrev;

    /**
     * @var int
     *
     * @ORM\Column(name="medianPrice_ytdPrev", type="integer", nullable=true)
     */
    public $medianPrice_ytdPrev;

    /**
     * @var float
     *
     * @ORM\Column(name="percentReceived_ytdPrev", type="float", nullable=true)
     */
    public $percentReceived_ytdPrev;

    /**
     * @var float
     *
     * @ORM\Column(name="daysOnMarket_ytdPrev", type="float", nullable=true)
     */
    public $daysOnMarket_ytdPrev;


    /**
     * @var int
     *
     * @ORM\Column(name="newListings_ytdCurr", type="integer", nullable=true)
     */
    public $newListings_ytdCurr;

    /**
     * @var int
     *
     * @ORM\Column(name="salesReported_ytdCurr", type="integer", nullable=true)
     */
    public $salesReported_ytdCurr;

    /**
     * @var int
     *
     * @ORM\Column(name="salesProjected_ytdCurr", type="integer", nullable=true)
     */
    public $salesProjected_ytdCurr;

    /**
     * @var int
     *
     * @ORM\Column(name="contractListings_ytdCurr", type="integer", nullable=true)
     */
    public $contractListings_ytdCurr;

    /**
     * @var int
     *
     * @ORM\Column(name="avgPrice_ytdCurr", type="integer", nullable=true)
     */
    public $avgPrice_ytdCurr;

    /**
     * @var int
     *
     * @ORM\Column(name="medianPrice_ytdCurr", type="integer", nullable=true)
     */
    public $medianPrice_ytdCurr;

    /**
     * @var float
     *
     * @ORM\Column(name="percentReceived_ytdCurr", type="float", nullable=true)
     */
    public $percentReceived_ytdCurr;

    /**
     * @var float
     *
     * @ORM\Column(name="daysOnMarket_ytdCurr", type="float", nullable=true)
     */
    public $daysOnMarket_ytdCurr;


    /**
     * @var float
     *
     * @ORM\Column(name="newListings_ytdChange", type="float", nullable=true)
     */
    public $newListings_ytdChange;

    /**
     * @var float
     *
     * @ORM\Column(name="salesReported_ytdChange", type="float", nullable=true)
     */
    public $salesReported_ytdChange;

    /**
     * @var float
     *
     * @ORM\Column(name="salesProjected_ytdChange", type="float", nullable=true)
     */
    public $salesProjected_ytdChange;

    /**
     * @var float
     *
     * @ORM\Column(name="contractListings_ytdChange", type="float", nullable=true)
     */
    public $contractListings_ytdChange;

    /**
     * @var float
     *
     * @ORM\Column(name="avgPrice_ytdChange", type="float", nullable=true)
     */
    public $avgPrice_ytdChange;

    /**
     * @var float
     *
     * @ORM\Column(name="medianPrice_ytdChange", type="float", nullable=true)
     */
    public $medianPrice_ytdChange;

    /**
     * @var float
     *
     * @ORM\Column(name="percentReceived_ytdChange", type="float", nullable=true)
     */
    public $percentReceived_ytdChange;

    /**
     * @var float
     *
     * @ORM\Column(name="daysOnMarket_ytdChange", type="float", nullable=true)
     */
    public $daysOnMarket_ytdChange;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     *
     * @return CityReport
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return int
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @param int $year
     *
     * @return CityReport
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * @return int
     */
    public function getMonth()
    {
        return $this->month;
    }

    /**
     * @param int $month
     *
     * @return CityReport
     */
    public function setMonth($month)
    {
        $this->month = $month;

        return $this;
    }

    /**
     * @return int
     */
    public function getSalesReportedMonthPrev()
    {
        return $this->salesReported_monthPrev;
    }

    /**
     * @param int $salesReported_monthPrev
     *
     * @return CityReport
     */
    public function setSalesReportedMonthPrev($salesReported_monthPrev)
    {
        $this->salesReported_monthPrev = $salesReported_monthPrev;

        return $this;
    }

    /**
     * @return int
     */
    public function getSalesProjectedMonthPrev()
    {
        return $this->salesProjected_monthPrev;
    }

    /**
     * @param int $salesProjected_monthPrev
     *
     * @return CityReport
     */
    public function setSalesProjectedMonthPrev($salesProjected_monthPrev)
    {
        $this->salesProjected_monthPrev = $salesProjected_monthPrev;

        return $this;
    }

    /**
     * @return int
     */
    public function getContractListingsMonthPrev()
    {
        return $this->contractListings_monthPrev;
    }

    /**
     * @param int $contractListings_monthPrev
     *
     * @return CityReport
     */
    public function setContractListingsMonthPrev($contractListings_monthPrev)
    {
        $this->contractListings_monthPrev = $contractListings_monthPrev;

        return $this;
    }

    /**
     * @return int
     */
    public function getAvgPriceMonthPrev()
    {
        return $this->avgPrice_monthPrev;
    }

    /**
     * @param int $avgPrice_monthPrev
     *
     * @return CityReport
     */
    public function setAvgPriceMonthPrev($avgPrice_monthPrev)
    {
        $this->avgPrice_monthPrev = $avgPrice_monthPrev;

        return $this;
    }

    /**
     * @return int
     */
    public function getMedianPriceMonthPrev()
    {
        return $this->medianPrice_monthPrev;
    }

    /**
     * @param int $medianPrice_monthPrev
     *
     * @return CityReport
     */
    public function setMedianPriceMonthPrev($medianPrice_monthPrev)
    {
        $this->medianPrice_monthPrev = $medianPrice_monthPrev;

        return $this;
    }

    /**
     * @return float
     */
    public function getPercentReceivedMonthPrev()
    {
        return $this->percentReceived_monthPrev;
    }

    /**
     * @param float $percentReceived_monthPrev
     *
     * @return CityReport
     */
    public function setPercentReceivedMonthPrev($percentReceived_monthPrev)
    {
        $this->percentReceived_monthPrev = $percentReceived_monthPrev;

        return $this;
    }

    /**
     * @return float
     */
    public function getDaysOnMarketMonthPrev()
    {
        return $this->daysOnMarket_monthPrev;
    }

    /**
     * @param float $daysOnMarket_monthPrev
     *
     * @return CityReport
     */
    public function setDaysOnMarketMonthPrev($daysOnMarket_monthPrev)
    {
        $this->daysOnMarket_monthPrev = $daysOnMarket_monthPrev;

        return $this;
    }

    /**
     * @return int
     */
    public function getInventoryMonthPrev()
    {
        return $this->inventory_monthPrev;
    }

    /**
     * @param int $inventory_monthPrev
     *
     * @return CityReport
     */
    public function setInventoryMonthPrev($inventory_monthPrev)
    {
        $this->inventory_monthPrev = $inventory_monthPrev;

        return $this;
    }

    /**
     * @return int
     */
    public function getMonthsSupplyMonthPrev()
    {
        return $this->monthsSupply_monthPrev;
    }

    /**
     * @param int $monthsSupply_monthPrev
     *
     * @return CityReport
     */
    public function setMonthsSupplyMonthPrev($monthsSupply_monthPrev)
    {
        $this->monthsSupply_monthPrev = $monthsSupply_monthPrev;

        return $this;
    }

    /**
     * @return int
     */
    public function getSalesReportedMonthCurr()
    {
        return $this->salesReported_monthCurr;
    }

    /**
     * @param int $salesReported_monthCurr
     *
     * @return CityReport
     */
    public function setSalesReportedMonthCurr($salesReported_monthCurr)
    {
        $this->salesReported_monthCurr = $salesReported_monthCurr;

        return $this;
    }

    /**
     * @return int
     */
    public function getSalesProjectedMonthCurr()
    {
        return $this->salesProjected_monthCurr;
    }

    /**
     * @param int $salesProjected_monthCurr
     *
     * @return CityReport
     */
    public function setSalesProjectedMonthCurr($salesProjected_monthCurr)
    {
        $this->salesProjected_monthCurr = $salesProjected_monthCurr;

        return $this;
    }

    /**
     * @return int
     */
    public function getContractListingsMonthCurr()
    {
        return $this->contractListings_monthCurr;
    }

    /**
     * @param int $contractListings_monthCurr
     *
     * @return CityReport
     */
    public function setContractListingsMonthCurr($contractListings_monthCurr)
    {
        $this->contractListings_monthCurr = $contractListings_monthCurr;

        return $this;
    }

    /**
     * @return int
     */
    public function getAvgPriceMonthCurr()
    {
        return $this->avgPrice_monthCurr;
    }

    /**
     * @param int $avgPrice_monthCurr
     *
     * @return CityReport
     */
    public function setAvgPriceMonthCurr($avgPrice_monthCurr)
    {
        $this->avgPrice_monthCurr = $avgPrice_monthCurr;

        return $this;
    }

    /**
     * @return int
     */
    public function getMedianPriceMonthCurr()
    {
        return $this->medianPrice_monthCurr;
    }

    /**
     * @param int $medianPrice_monthCurr
     *
     * @return CityReport
     */
    public function setMedianPriceMonthCurr($medianPrice_monthCurr)
    {
        $this->medianPrice_monthCurr = $medianPrice_monthCurr;

        return $this;
    }

    /**
     * @return float
     */
    public function getPercentReceivedMonthCurr()
    {
        return $this->percentReceived_monthCurr;
    }

    /**
     * @param float $percentReceived_monthCurr
     *
     * @return CityReport
     */
    public function setPercentReceivedMonthCurr($percentReceived_monthCurr)
    {
        $this->percentReceived_monthCurr = $percentReceived_monthCurr;

        return $this;
    }

    /**
     * @return float
     */
    public function getDaysOnMarketMonthCurr()
    {
        return $this->daysOnMarket_monthCurr;
    }

    /**
     * @param float $daysOnMarket_monthCurr
     *
     * @return CityReport
     */
    public function setDaysOnMarketMonthCurr($daysOnMarket_monthCurr)
    {
        $this->daysOnMarket_monthCurr = $daysOnMarket_monthCurr;

        return $this;
    }

    /**
     * @return int
     */
    public function getInventoryMonthCurr()
    {
        return $this->inventory_monthCurr;
    }

    /**
     * @param int $inventory_monthCurr
     *
     * @return CityReport
     */
    public function setInventoryMonthCurr($inventory_monthCurr)
    {
        $this->inventory_monthCurr = $inventory_monthCurr;

        return $this;
    }

    /**
     * @return int
     */
    public function getMonthsSupplyMonthCurr()
    {
        return $this->monthsSupply_monthCurr;
    }

    /**
     * @param int $monthsSupply_monthCurr
     *
     * @return CityReport
     */
    public function setMonthsSupplyMonthCurr($monthsSupply_monthCurr)
    {
        $this->monthsSupply_monthCurr = $monthsSupply_monthCurr;

        return $this;
    }

    /**
     * @return float
     */
    public function getSalesReportedMonthChange()
    {
        return $this->salesReported_monthChange;
    }

    /**
     * @param float $salesReported_monthChange
     *
     * @return CityReport
     */
    public function setSalesReportedMonthChange($salesReported_monthChange)
    {
        $this->salesReported_monthChange = $salesReported_monthChange;

        return $this;
    }

    /**
     * @return float
     */
    public function getSalesProjectedMonthChange()
    {
        return $this->salesProjected_monthChange;
    }

    /**
     * @param float $salesProjected_monthChange
     *
     * @return CityReport
     */
    public function setSalesProjectedMonthChange($salesProjected_monthChange)
    {
        $this->salesProjected_monthChange = $salesProjected_monthChange;

        return $this;
    }

    /**
     * @return float
     */
    public function getContractListingsMonthChange()
    {
        return $this->contractListings_monthChange;
    }

    /**
     * @param float $contractListings_monthChange
     *
     * @return CityReport
     */
    public function setContractListingsMonthChange($contractListings_monthChange)
    {
        $this->contractListings_monthChange = $contractListings_monthChange;

        return $this;
    }

    /**
     * @return float
     */
    public function getAvgPriceMonthChange()
    {
        return $this->avgPrice_monthChange;
    }

    /**
     * @param float $avgPrice_monthChange
     *
     * @return CityReport
     */
    public function setAvgPriceMonthChange($avgPrice_monthChange)
    {
        $this->avgPrice_monthChange = $avgPrice_monthChange;

        return $this;
    }

    /**
     * @return float
     */
    public function getMedianPriceMonthChange()
    {
        return $this->medianPrice_monthChange;
    }

    /**
     * @param float $medianPrice_monthChange
     *
     * @return CityReport
     */
    public function setMedianPriceMonthChange($medianPrice_monthChange)
    {
        $this->medianPrice_monthChange = $medianPrice_monthChange;

        return $this;
    }

    /**
     * @return float
     */
    public function getPercentReceivedMonthChange()
    {
        return $this->percentReceived_monthChange;
    }

    /**
     * @param float $percentReceived_monthChange
     *
     * @return CityReport
     */
    public function setPercentReceivedMonthChange($percentReceived_monthChange)
    {
        $this->percentReceived_monthChange = $percentReceived_monthChange;

        return $this;
    }

    /**
     * @return float
     */
    public function getDaysOnMarketMonthChange()
    {
        return $this->daysOnMarket_monthChange;
    }

    /**
     * @param float $daysOnMarket_monthChange
     *
     * @return CityReport
     */
    public function setDaysOnMarketMonthChange($daysOnMarket_monthChange)
    {
        $this->daysOnMarket_monthChange = $daysOnMarket_monthChange;

        return $this;
    }

    /**
     * @return float
     */
    public function getInventoryMonthChange()
    {
        return $this->inventory_monthChange;
    }

    /**
     * @param float $inventory_monthChange
     *
     * @return CityReport
     */
    public function setInventoryMonthChange($inventory_monthChange)
    {
        $this->inventory_monthChange = $inventory_monthChange;

        return $this;
    }

    /**
     * @return float
     */
    public function getMonthsSupplyMonthChange()
    {
        return $this->monthsSupply_monthChange;
    }

    /**
     * @param float $monthsSupply_monthChange
     *
     * @return CityReport
     */
    public function setMonthsSupplyMonthChange($monthsSupply_monthChange)
    {
        $this->monthsSupply_monthChange = $monthsSupply_monthChange;

        return $this;
    }

    /**
     * @return int
     */
    public function getSalesReportedYtdPrev()
    {
        return $this->salesReported_ytdPrev;
    }

    /**
     * @param int $salesReported_ytdPrev
     *
     * @return CityReport
     */
    public function setSalesReportedYtdPrev($salesReported_ytdPrev)
    {
        $this->salesReported_ytdPrev = $salesReported_ytdPrev;

        return $this;
    }

    /**
     * @return int
     */
    public function getSalesProjectedYtdPrev()
    {
        return $this->salesProjected_ytdPrev;
    }

    /**
     * @param int $salesProjected_ytdPrev
     *
     * @return CityReport
     */
    public function setSalesProjectedYtdPrev($salesProjected_ytdPrev)
    {
        $this->salesProjected_ytdPrev = $salesProjected_ytdPrev;

        return $this;
    }

    /**
     * @return int
     */
    public function getContractListingsYtdPrev()
    {
        return $this->contractListings_ytdPrev;
    }

    /**
     * @param int $contractListings_ytdPrev
     *
     * @return CityReport
     */
    public function setContractListingsYtdPrev($contractListings_ytdPrev)
    {
        $this->contractListings_ytdPrev = $contractListings_ytdPrev;

        return $this;
    }

    /**
     * @return int
     */
    public function getAvgPriceYtdPrev()
    {
        return $this->avgPrice_ytdPrev;
    }

    /**
     * @param int $avgPrice_ytdPrev
     *
     * @return CityReport
     */
    public function setAvgPriceYtdPrev($avgPrice_ytdPrev)
    {
        $this->avgPrice_ytdPrev = $avgPrice_ytdPrev;

        return $this;
    }

    /**
     * @return int
     */
    public function getMedianPriceYtdPrev()
    {
        return $this->medianPrice_ytdPrev;
    }

    /**
     * @param int $medianPrice_ytdPrev
     *
     * @return CityReport
     */
    public function setMedianPriceYtdPrev($medianPrice_ytdPrev)
    {
        $this->medianPrice_ytdPrev = $medianPrice_ytdPrev;

        return $this;
    }

    /**
     * @return float
     */
    public function getPercentReceivedYtdPrev()
    {
        return $this->percentReceived_ytdPrev;
    }

    /**
     * @param float $percentReceived_ytdPrev
     *
     * @return CityReport
     */
    public function setPercentReceivedYtdPrev($percentReceived_ytdPrev)
    {
        $this->percentReceived_ytdPrev = $percentReceived_ytdPrev;

        return $this;
    }

    /**
     * @return float
     */
    public function getDaysOnMarketYtdPrev()
    {
        return $this->daysOnMarket_ytdPrev;
    }

    /**
     * @param float $daysOnMarket_ytdPrev
     *
     * @return CityReport
     */
    public function setDaysOnMarketYtdPrev($daysOnMarket_ytdPrev)
    {
        $this->daysOnMarket_ytdPrev = $daysOnMarket_ytdPrev;

        return $this;
    }

    /**
     * @return int
     */
    public function getSalesReportedYtdCurr()
    {
        return $this->salesReported_ytdCurr;
    }

    /**
     * @param int $salesReported_ytdCurr
     *
     * @return CityReport
     */
    public function setSalesReportedYtdCurr($salesReported_ytdCurr)
    {
        $this->salesReported_ytdCurr = $salesReported_ytdCurr;

        return $this;
    }

    /**
     * @return int
     */
    public function getSalesProjectedYtdCurr()
    {
        return $this->salesProjected_ytdCurr;
    }

    /**
     * @param int $salesProjected_ytdCurr
     *
     * @return CityReport
     */
    public function setSalesProjectedYtdCurr($salesProjected_ytdCurr)
    {
        $this->salesProjected_ytdCurr = $salesProjected_ytdCurr;

        return $this;
    }

    /**
     * @return int
     */
    public function getContractListingsYtdCurr()
    {
        return $this->contractListings_ytdCurr;
    }

    /**
     * @param int $contractListings_ytdCurr
     *
     * @return CityReport
     */
    public function setContractListingsYtdCurr($contractListings_ytdCurr)
    {
        $this->contractListings_ytdCurr = $contractListings_ytdCurr;

        return $this;
    }

    /**
     * @return int
     */
    public function getAvgPriceYtdCurr()
    {
        return $this->avgPrice_ytdCurr;
    }

    /**
     * @param int $avgPrice_ytdCurr
     *
     * @return CityReport
     */
    public function setAvgPriceYtdCurr($avgPrice_ytdCurr)
    {
        $this->avgPrice_ytdCurr = $avgPrice_ytdCurr;

        return $this;
    }

    /**
     * @return int
     */
    public function getMedianPriceYtdCurr()
    {
        return $this->medianPrice_ytdCurr;
    }

    /**
     * @param int $medianPrice_ytdCurr
     *
     * @return CityReport
     */
    public function setMedianPriceYtdCurr($medianPrice_ytdCurr)
    {
        $this->medianPrice_ytdCurr = $medianPrice_ytdCurr;

        return $this;
    }

    /**
     * @return float
     */
    public function getPercentReceivedYtdCurr()
    {
        return $this->percentReceived_ytdCurr;
    }

    /**
     * @param float $percentReceived_ytdCurr
     *
     * @return CityReport
     */
    public function setPercentReceivedYtdCurr($percentReceived_ytdCurr)
    {
        $this->percentReceived_ytdCurr = $percentReceived_ytdCurr;

        return $this;
    }

    /**
     * @return float
     */
    public function getDaysOnMarketYtdCurr()
    {
        return $this->daysOnMarket_ytdCurr;
    }

    /**
     * @param float $daysOnMarket_ytdCurr
     *
     * @return CityReport
     */
    public function setDaysOnMarketYtdCurr($daysOnMarket_ytdCurr)
    {
        $this->daysOnMarket_ytdCurr = $daysOnMarket_ytdCurr;

        return $this;
    }

    /**
     * @return float
     */
    public function getSalesReportedYtdChange()
    {
        return $this->salesReported_ytdChange;
    }

    /**
     * @param float $salesReported_ytdChange
     *
     * @return CityReport
     */
    public function setSalesReportedYtdChange($salesReported_ytdChange)
    {
        $this->salesReported_ytdChange = $salesReported_ytdChange;

        return $this;
    }

    /**
     * @return float
     */
    public function getSalesProjectedYtdChange()
    {
        return $this->salesProjected_ytdChange;
    }

    /**
     * @param float $salesProjected_ytdChange
     *
     * @return CityReport
     */
    public function setSalesProjectedYtdChange($salesProjected_ytdChange)
    {
        $this->salesProjected_ytdChange = $salesProjected_ytdChange;

        return $this;
    }

    /**
     * @return float
     */
    public function getContractListingsYtdChange()
    {
        return $this->contractListings_ytdChange;
    }

    /**
     * @param float $contractListings_ytdChange
     *
     * @return CityReport
     */
    public function setContractListingsYtdChange($contractListings_ytdChange)
    {
        $this->contractListings_ytdChange = $contractListings_ytdChange;

        return $this;
    }

    /**
     * @return float
     */
    public function getAvgPriceYtdChange()
    {
        return $this->avgPrice_ytdChange;
    }

    /**
     * @param float $avgPrice_ytdChange
     *
     * @return CityReport
     */
    public function setAvgPriceYtdChange($avgPrice_ytdChange)
    {
        $this->avgPrice_ytdChange = $avgPrice_ytdChange;

        return $this;
    }

    /**
     * @return float
     */
    public function getMedianPriceYtdChange()
    {
        return $this->medianPrice_ytdChange;
    }

    /**
     * @param float $medianPrice_ytdChange
     *
     * @return CityReport
     */
    public function setMedianPriceYtdChange($medianPrice_ytdChange)
    {
        $this->medianPrice_ytdChange = $medianPrice_ytdChange;

        return $this;
    }

    /**
     * @return float
     */
    public function getPercentReceivedYtdChange()
    {
        return $this->percentReceived_ytdChange;
    }

    /**
     * @param float $percentReceived_ytdChange
     *
     * @return CityReport
     */
    public function setPercentReceivedYtdChange($percentReceived_ytdChange)
    {
        $this->percentReceived_ytdChange = $percentReceived_ytdChange;

        return $this;
    }

    /**
     * @return float
     */
    public function getDaysOnMarketYtdChange()
    {
        return $this->daysOnMarket_ytdChange;
    }

    /**
     * @param float $daysOnMarket_ytdChange
     *
     * @return CityReport
     */
    public function setDaysOnMarketYtdChange($daysOnMarket_ytdChange)
    {
        $this->daysOnMarket_ytdChange = $daysOnMarket_ytdChange;

        return $this;
    }

    /**
     * @return int
     */
    public function getNewListingsMonthPrev()
    {
        return $this->newListings_monthPrev;
    }

    /**
     * @param int $newListings_monthPrev
     * @return CityReport
     */
    public function setNewListingsMonthPrev($newListings_monthPrev)
    {
        $this->newListings_monthPrev = $newListings_monthPrev;

        return $this;
    }

    /**
     * @return int
     */
    public function getNewListingsMonthCurr()
    {
        return $this->newListings_monthCurr;
    }

    /**
     * @param int $newListings_monthCurr
     * @return CityReport
     */
    public function setNewListingsMonthCurr($newListings_monthCurr)
    {
        $this->newListings_monthCurr = $newListings_monthCurr;

        return $this;
    }

    /**
     * @return float
     */
    public function getNewListingsMonthChange()
    {
        return $this->newListings_monthChange;
    }

    /**
     * @param float $newListings_monthChange
     * @return CityReport
     */
    public function setNewListingsMonthChange($newListings_monthChange)
    {
        $this->newListings_monthChange = $newListings_monthChange;

        return $this;
    }

    /**
     * @return int
     */
    public function getNewListingsYtdPrev()
    {
        return $this->newListings_ytdPrev;
    }

    /**
     * @param int $newListings_ytdPrev
     * @return CityReport
     */
    public function setNewListingsYtdPrev($newListings_ytdPrev)
    {
        $this->newListings_ytdPrev = $newListings_ytdPrev;

        return $this;
    }

    /**
     * @return int
     */
    public function getNewListingsYtdCurr()
    {
        return $this->newListings_ytdCurr;
    }

    /**
     * @param int $newListings_ytdCurr
     * @return CityReport
     */
    public function setNewListingsYtdCurr($newListings_ytdCurr)
    {
        $this->newListings_ytdCurr = $newListings_ytdCurr;

        return $this;
    }

    /**
     * @return float
     */
    public function getNewListingsYtdChange()
    {
        return $this->newListings_ytdChange;
    }

    /**
     * @param float $newListings_ytdChange
     * @return CityReport
     */
    public function setNewListingsYtdChange($newListings_ytdChange)
    {
        $this->newListings_ytdChange = $newListings_ytdChange;

        return $this;
    }



}