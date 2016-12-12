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
     * @var int
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\City", inversedBy="reports")
     * @ORM\JoinColumn(name="city_id", referencedColumnName="id")
     */
    protected $city;

    /**
     * @var int
     *
     * @ORM\Column(name="year", type="integer")
     */
    protected $year;

    /**
     * @var int
     *
     * @ORM\Column(name="month", type="integer")
     */
    protected $month;

    
    /**
     * @var int
     *
     * @ORM\Column(name="newListings_monthPrev", type="integer", nullable=true)
     */
    protected $newListings_monthPrev;

    /**
     * @var int
     *
     * @ORM\Column(name="salesReported_monthPrev", type="integer", nullable=true)
     */
    protected $salesReported_monthPrev;

    /**
     * @var int
     *
     * @ORM\Column(name="salesProjected_monthPrev", type="integer", nullable=true)
     */
    protected $salesProjected_monthPrev;

    /**
     * @var int
     *
     * @ORM\Column(name="listings_monthPrev", type="integer", nullable=true)
     */
    protected $listings_monthPrev;

    /**
     * @var int
     *
     * @ORM\Column(name="avgPrice_monthPrev", type="integer", nullable=true)
     */
    protected $avgPrice_monthPrev;

    /**
     * @var int
     *
     * @ORM\Column(name="medianPrice_monthPrev", type="integer", nullable=true)
     */
    protected $medianPrice_monthPrev;

    /**
     * @var float
     *
     * @ORM\Column(name="percentReceived_monthPrev", type="float", nullable=true)
     */
    protected $percentReceived_monthPrev;

    /**
     * @var float
     *
     * @ORM\Column(name="daysOnMarket_monthPrev", type="float", nullable=true)
     */
    protected $daysOnMarket_monthPrev;

    /**
     * @var int
     *
     * @ORM\Column(name="inventory_monthPrev", type="integer", nullable=true)
     */
    protected $inventory_monthPrev;

    /**
     * @var int
     *
     * @ORM\Column(name="monthsSupply_monthPrev", type="integer", nullable=true)
     */
    protected $monthsSupply_monthPrev;

    /**
     * @var int
     *
     * @ORM\Column(name="newListings_monthCurr", type="integer", nullable=true)
     */
    protected $newListings_monthCurr;

    /**
     * @var int
     *
     * @ORM\Column(name="salesReported_monthCurr", type="integer", nullable=true)
     */
    protected $salesReported_monthCurr;

    /**
     * @var int
     *
     * @ORM\Column(name="salesProjected_monthCurr", type="integer", nullable=true)
     */
    protected $salesProjected_monthCurr;

    /**
     * @var int
     *
     * @ORM\Column(name="listings_monthCurr", type="integer", nullable=true)
     */
    protected $listings_monthCurr;

    /**
     * @var int
     *
     * @ORM\Column(name="avgPrice_monthCurr", type="integer", nullable=true)
     */
    protected $avgPrice_monthCurr;

    /**
     * @var int
     *
     * @ORM\Column(name="medianPrice_monthCurr", type="integer", nullable=true)
     */
    protected $medianPrice_monthCurr;

    /**
     * @var float
     *
     * @ORM\Column(name="percentReceived_monthCurr", type="float", nullable=true)
     */
    protected $percentReceived_monthCurr;

    /**
     * @var float
     *
     * @ORM\Column(name="daysOnMarket_monthCurr", type="float", nullable=true)
     */
    protected $daysOnMarket_monthCurr;

    /**
     * @var int
     *
     * @ORM\Column(name="inventory_monthCurr", type="integer", nullable=true)
     */
    protected $inventory_monthCurr;

    /**
     * @var int
     *
     * @ORM\Column(name="monthsSupply_monthCurr", type="integer", nullable=true)
     */
    protected $monthsSupply_monthCurr;


    /**
     * @var float
     *
     * @ORM\Column(name="newListings_monthChange", type="float", nullable=true)
     */
    protected $newListings_monthChange;

    /**
     * @var float
     *
     * @ORM\Column(name="salesReported_monthChange", type="float", nullable=true)
     */
    protected $salesReported_monthChange;

    /**
     * @var float
     *
     * @ORM\Column(name="salesProjected_monthChange", type="float", nullable=true)
     */
    protected $salesProjected_monthChange;

    /**
     * @var float
     *
     * @ORM\Column(name="listings_monthChange", type="float", nullable=true)
     */
    protected $listings_monthChange;

    /**
     * @var float
     *
     * @ORM\Column(name="avgPrice_monthChange", type="float", nullable=true)
     */
    protected $avgPrice_monthChange;

    /**
     * @var float
     *
     * @ORM\Column(name="medianPrice_monthChange", type="float", nullable=true)
     */
    protected $medianPrice_monthChange;

    /**
     * @var float
     *
     * @ORM\Column(name="percentReceived_monthChange", type="float", nullable=true)
     */
    protected $percentReceived_monthChange;

    /**
     * @var float
     *
     * @ORM\Column(name="daysOnMarket_monthChange", type="float", nullable=true)
     */
    protected $daysOnMarket_monthChange;

    /**
     * @var float
     *
     * @ORM\Column(name="inventory_monthChange", type="float", nullable=true)
     */
    protected $inventory_monthChange;

    /**
     * @var float
     *
     * @ORM\Column(name="monthsSupply_monthChange", type="float", nullable=true)
     */
    protected $monthsSupply_monthChange;


    /**
     * @var int
     *
     * @ORM\Column(name="newListings_ytdPrev", type="integer", nullable=true)
     */
    protected $newListings_ytdPrev;

    /**
     * @var int
     *
     * @ORM\Column(name="salesReported_ytdPrev", type="integer", nullable=true)
     */
    protected $salesReported_ytdPrev;

    /**
     * @var int
     *
     * @ORM\Column(name="salesProjected_ytdPrev", type="integer", nullable=true)
     */
    protected $salesProjected_ytdPrev;

    /**
     * @var int
     *
     * @ORM\Column(name="listings_ytdPrev", type="integer", nullable=true)
     */
    protected $listings_ytdPrev;

    /**
     * @var int
     *
     * @ORM\Column(name="avgPrice_ytdPrev", type="integer", nullable=true)
     */
    protected $avgPrice_ytdPrev;

    /**
     * @var int
     *
     * @ORM\Column(name="medianPrice_ytdPrev", type="integer", nullable=true)
     */
    protected $medianPrice_ytdPrev;

    /**
     * @var float
     *
     * @ORM\Column(name="percentReceived_ytdPrev", type="float", nullable=true)
     */
    protected $percentReceived_ytdPrev;

    /**
     * @var float
     *
     * @ORM\Column(name="daysOnMarket_ytdPrev", type="float", nullable=true)
     */
    protected $daysOnMarket_ytdPrev;

    /**
     * @var int
     *
     * @ORM\Column(name="inventory_ytdPrev", type="integer", nullable=true)
     */
    protected $inventory_ytdPrev;

    /**
     * @var int
     *
     * @ORM\Column(name="monthsSupply_ytdPrev", type="integer", nullable=true)
     */
    protected $monthsSupply_ytdPrev;


    /**
     * @var int
     *
     * @ORM\Column(name="newListings_ytdCurr", type="integer", nullable=true)
     */
    protected $newListings_ytdCurr;

    /**
     * @var int
     *
     * @ORM\Column(name="salesReported_ytdCurr", type="integer", nullable=true)
     */
    protected $salesReported_ytdCurr;

    /**
     * @var int
     *
     * @ORM\Column(name="salesProjected_ytdCurr", type="integer", nullable=true)
     */
    protected $salesProjected_ytdCurr;

    /**
     * @var int
     *
     * @ORM\Column(name="listings_ytdCurr", type="integer", nullable=true)
     */
    protected $listings_ytdCurr;

    /**
     * @var int
     *
     * @ORM\Column(name="avgPrice_ytdCurr", type="integer", nullable=true)
     */
    protected $avgPrice_ytdCurr;

    /**
     * @var int
     *
     * @ORM\Column(name="medianPrice_ytdCurr", type="integer", nullable=true)
     */
    protected $medianPrice_ytdCurr;

    /**
     * @var float
     *
     * @ORM\Column(name="percentReceived_ytdCurr", type="float", nullable=true)
     */
    protected $percentReceived_ytdCurr;

    /**
     * @var float
     *
     * @ORM\Column(name="daysOnMarket_ytdCurr", type="float", nullable=true)
     */
    protected $daysOnMarket_ytdCurr;

    /**
     * @var int
     *
     * @ORM\Column(name="inventory_ytdCurr", type="integer", nullable=true)
     */
    protected $inventory_ytdCurr;

    /**
     * @var int
     *
     * @ORM\Column(name="monthsSupply_ytdCurr", type="integer", nullable=true)
     */
    protected $monthsSupply_ytdCurr;


    /**
     * @var float
     *
     * @ORM\Column(name="newListings_ytdChange", type="float", nullable=true)
     */
    protected $newListings_ytdChange;

    /**
     * @var float
     *
     * @ORM\Column(name="salesReported_ytdChange", type="float", nullable=true)
     */
    protected $salesReported_ytdChange;

    /**
     * @var float
     *
     * @ORM\Column(name="salesProjected_ytdChange", type="float", nullable=true)
     */
    protected $salesProjected_ytdChange;

    /**
     * @var float
     *
     * @ORM\Column(name="listings_ytdChange", type="float", nullable=true)
     */
    protected $listings_ytdChange;

    /**
     * @var float
     *
     * @ORM\Column(name="avgPrice_ytdChange", type="float", nullable=true)
     */
    protected $avgPrice_ytdChange;

    /**
     * @var float
     *
     * @ORM\Column(name="medianPrice_ytdChange", type="float", nullable=true)
     */
    protected $medianPrice_ytdChange;

    /**
     * @var float
     *
     * @ORM\Column(name="percentReceived_ytdChange", type="float", nullable=true)
     */
    protected $percentReceived_ytdChange;

    /**
     * @var float
     *
     * @ORM\Column(name="daysOnMarket_ytdChange", type="float", nullable=true)
     */
    protected $daysOnMarket_ytdChange;

    /**
     * @var float
     *
     * @ORM\Column(name="inventory_ytdChange", type="float", nullable=true)
     */
    protected $inventory_ytdChange;

    /**
     * @var float
     *
     * @ORM\Column(name="monthsSupply_ytdChange", type="float", nullable=true)
     */
    protected $monthsSupply_ytdChange;


//
//    protected function foo() {
//
//        $newListings;
//        $salesReported;
//        $salesProjected;
//        $listings;
//        $avgPrice;
//        $medianPrice;
//        $percentReceived;
//        $daysOnMarket;
//        $inventory;
//        $monthsSupply;
//
//
//
//    }


}