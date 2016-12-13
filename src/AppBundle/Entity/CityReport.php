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


//    /**
//     * @var int
//     *
//     * @ORM\Column(name="newListings_monthPrev", type="integer", nullable=true)
//     */
//    public $newListings_monthPrev;

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

//    /**
//     * @var int
//     *
//     * @ORM\Column(name="newListings_monthCurr", type="integer", nullable=true)
//     */
//    public $newListings_monthCurr;

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


//    /**
//     * @var float
//     *
//     * @ORM\Column(name="newListings_monthChange", type="float", nullable=true)
//     */
//    public $newListings_monthChange;

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


//    /**
//     * @var int
//     *
//     * @ORM\Column(name="newListings_ytdPrev", type="integer", nullable=true)
//     */
//    public $newListings_ytdPrev;

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
     * @ORM\Column(name="inventory_ytdPrev", type="integer", nullable=true)
     */
    public $inventory_ytdPrev;

    /**
     * @var int
     *
     * @ORM\Column(name="monthsSupply_ytdPrev", type="integer", nullable=true)
     */
    public $monthsSupply_ytdPrev;


//    /**
//     * @var int
//     *
//     * @ORM\Column(name="newListings_ytdCurr", type="integer", nullable=true)
//     */
//    public $newListings_ytdCurr;

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
     * @var int
     *
     * @ORM\Column(name="inventory_ytdCurr", type="integer", nullable=true)
     */
    public $inventory_ytdCurr;

    /**
     * @var int
     *
     * @ORM\Column(name="monthsSupply_ytdCurr", type="integer", nullable=true)
     */
    public $monthsSupply_ytdCurr;


//    /**
//     * @var float
//     *
//     * @ORM\Column(name="newListings_ytdChange", type="float", nullable=true)
//     */
//    public $newListings_ytdChange;

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
     * @var float
     *
     * @ORM\Column(name="inventory_ytdChange", type="float", nullable=true)
     */
    public $inventory_ytdChange;

    /**
     * @var float
     *
     * @ORM\Column(name="monthsSupply_ytdChange", type="float", nullable=true)
     */
    public $monthsSupply_ytdChange;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

}