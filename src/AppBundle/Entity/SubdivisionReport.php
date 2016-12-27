<?php

namespace AppBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Range;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="subdivision_report")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SubdivisionRepository")
 */
class SubdivisionReport implements ReportInterface
{

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=true)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Subdivision", inversedBy="reports")
     * @ORM\JoinColumn(name="subdivision_id", referencedColumnName="id")
     */
    public $subdivision;

    /**
     * @ORM\Column(name="start", type="date")
     */
    public $start;

    /**
     * @ORM\Column(name="end", type="date")
     */
    public $end;

    public function getMissingDataFields()
    {
        // TODO: Implement getMissingDataFields() method.
    }


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
    public function getSubdivision()
    {
        return $this->subdivision;
    }

    /**
     * @param mixed $subdivision
     * @return SubdivisionReport
     */
    public function setSubdivision($subdivision)
    {
        $this->subdivision = $subdivision;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * @param mixed $start
     * @return SubdivisionReport
     */
    public function setStart($start)
    {
        $this->start = $start;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * @param mixed $end
     * @return SubdivisionReport
     */
    public function setEnd($end)
    {
        $this->end = $end;

        return $this;
    }

    /**
     * @var int
     *
     * @Range(min=0)
     * @ORM\Column(name="sqft_min", type="integer", nullable=true)
     */
    public $sqft_min;
    /**
     * @var int
     *
     * @Range(min=0)
     * @ORM\Column(name="sqft_max", type="integer", nullable=true)
     */
    public $sqft_max;
    /**
     * @var int
     *
     * @Range(min=0)
     * @ORM\Column(name="sqft_avg", type="integer", nullable=true)
     */
    public $sqft_avg;

    /**
     * @var int
     *
     * @Range(min=0)
     * @ORM\Column(name="price_min", type="integer", nullable=true)
     */
    public $price_min;
    /**
     * @var int
     *
     * @Range(min=0)
     * @ORM\Column(name="price_max", type="integer", nullable=true)
     */
    public $price_max;
    /**
     * @var int
     *
     * @Range(min=0)
     * @ORM\Column(name="price_avg", type="integer", nullable=true)
     */
    public $price_avg;

    /**
     * @var float
     *
     * @Range(min=0)
     * @ORM\Column(name="pricePerSqft_min", type="float", nullable=true)
     */
    public $pricePerSqft_min;
    /**
     * @var float
     *
     * @Range(min=0)
     * @ORM\Column(name="pricePerSqft_max", type="float", nullable=true)
     */
    public $pricePerSqft_max;
    /**
     * @var float
     *
     * @Range(min=0)
     * @ORM\Column(name="pricePerSqft_avg", type="float", nullable=true)
     */
    public $pricePerSqft_avg;

    /**
     * @var int
     *
     * @Range(min=0)
     * @ORM\Column(name="dom_min", type="integer", nullable=true)
     */
    public $dom_min;
    /**
     * @var int
     *
     * @Range(min=0)
     * @ORM\Column(name="dom_max", type="integer", nullable=true)
     */
    public $dom_max;
    /**
     * @var int
     *
     * @Range(min=0)
     * @ORM\Column(name="dom_avg", type="integer", nullable=true)
     */
    public $dom_avg;

    /**
     * @var int
     *
     * @Range(min=0)
     * @ORM\Column(name="year_min", type="integer", nullable=true)
     */
    public $year_min;
    /**
     * @var int
     *
     * @Range(min=0)
     * @ORM\Column(name="year_max", type="integer", nullable=true)
     */
    public $year_max;
    /**
     * @var int
     *
     * @Range(min=0)
     * @ORM\Column(name="year_avg", type="integer", nullable=true)
     */
    public $year_avg;

    /**
     * @return int
     */
    public function getSqftMin()
    {
        return $this->sqft_min;
    }

    /**
     * @param int $sqft_min
     * @return SubdivisionReport
     */
    public function setSqftMin($sqft_min)
    {
        $this->sqft_min = $sqft_min;

        return $this;
    }

    /**
     * @return int
     */
    public function getSqftMax()
    {
        return $this->sqft_max;
    }

    /**
     * @param int $sqft_max
     * @return SubdivisionReport
     */
    public function setSqftMax($sqft_max)
    {
        $this->sqft_max = $sqft_max;

        return $this;
    }

    /**
     * @return int
     */
    public function getSqftAvg()
    {
        return $this->sqft_avg;
    }

    /**
     * @param int $sqft_avg
     * @return SubdivisionReport
     */
    public function setSqftAvg($sqft_avg)
    {
        $this->sqft_avg = $sqft_avg;

        return $this;
    }

    /**
     * @return int
     */
    public function getPriceMin()
    {
        return $this->price_min;
    }

    /**
     * @param int $price_min
     * @return SubdivisionReport
     */
    public function setPriceMin($price_min)
    {
        $this->price_min = $price_min;

        return $this;
    }

    /**
     * @return int
     */
    public function getPriceMax()
    {
        return $this->price_max;
    }

    /**
     * @param int $price_max
     * @return SubdivisionReport
     */
    public function setPriceMax($price_max)
    {
        $this->price_max = $price_max;

        return $this;
    }

    /**
     * @return int
     */
    public function getPriceAvg()
    {
        return $this->price_avg;
    }

    /**
     * @param int $price_avg
     * @return SubdivisionReport
     */
    public function setPriceAvg($price_avg)
    {
        $this->price_avg = $price_avg;

        return $this;
    }

    /**
     * @return float
     */
    public function getPricePerSqftMin()
    {
        return $this->pricePerSqft_min;
    }

    /**
     * @param float $pricePerSqft_min
     * @return SubdivisionReport
     */
    public function setPricePerSqftMin($pricePerSqft_min)
    {
        $this->pricePerSqft_min = $pricePerSqft_min;

        return $this;
    }

    /**
     * @return float
     */
    public function getPricePerSqftMax()
    {
        return $this->pricePerSqft_max;
    }

    /**
     * @param float $pricePerSqft_max
     * @return SubdivisionReport
     */
    public function setPricePerSqftMax($pricePerSqft_max)
    {
        $this->pricePerSqft_max = $pricePerSqft_max;

        return $this;
    }

    /**
     * @return float
     */
    public function getPricePerSqftAvg()
    {
        return $this->pricePerSqft_avg;
    }

    /**
     * @param float $pricePerSqft_avg
     * @return SubdivisionReport
     */
    public function setPricePerSqftAvg($pricePerSqft_avg)
    {
        $this->pricePerSqft_avg = $pricePerSqft_avg;

        return $this;
    }

    /**
     * @return int
     */
    public function getDomMin()
    {
        return $this->dom_min;
    }

    /**
     * @param int $dom_min
     * @return SubdivisionReport
     */
    public function setDomMin($dom_min)
    {
        $this->dom_min = $dom_min;

        return $this;
    }

    /**
     * @return int
     */
    public function getDomMax()
    {
        return $this->dom_max;
    }

    /**
     * @param int $dom_max
     * @return SubdivisionReport
     */
    public function setDomMax($dom_max)
    {
        $this->dom_max = $dom_max;

        return $this;
    }

    /**
     * @return int
     */
    public function getDomAvg()
    {
        return $this->dom_avg;
    }

    /**
     * @param int $dom_avg
     * @return SubdivisionReport
     */
    public function setDomAvg($dom_avg)
    {
        $this->dom_avg = $dom_avg;

        return $this;
    }

    /**
     * @return int
     */
    public function getYearMin()
    {
        return $this->year_min;
    }

    /**
     * @param int $year_min
     * @return SubdivisionReport
     */
    public function setYearMin($year_min)
    {
        $this->year_min = $year_min;

        return $this;
    }

    /**
     * @return int
     */
    public function getYearMax()
    {
        return $this->year_max;
    }

    /**
     * @param int $year_max
     * @return SubdivisionReport
     */
    public function setYearMax($year_max)
    {
        $this->year_max = $year_max;

        return $this;
    }

    /**
     * @return int
     */
    public function getYearAvg()
    {
        return $this->year_avg;
    }

    /**
     * @param int $year_avg
     * @return SubdivisionReport
     */
    public function setYearAvg($year_avg)
    {
        $this->year_avg = $year_avg;

        return $this;
    }

}