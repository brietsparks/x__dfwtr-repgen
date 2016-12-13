<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="city")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CityRepository")
 */
class City
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
     * @var int
     *
     * @ORM\Column(name="mls", type="integer")
     */
    protected $mls;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", nullable=true)
     */
    protected $name;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\CityReport", mappedBy="city")
     */
    protected $reports;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Subdivision", mappedBy="city")
     */
    protected $subdivisions;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getMls()
    {
        return $this->mls;
    }

    /**
     * @param int $mls
     * @return City
     */
    public function setMls($mls)
    {
        $this->mls = $mls;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return City
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getReports()
    {
        return $this->reports;
    }

    /**
     * @param mixed $reports
     * @return City
     */
    public function setReports($reports)
    {
        $this->reports = $reports;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSubdivisions()
    {
        return $this->subdivisions;
    }

    /**
     * @param mixed $subdivisions
     * @return City
     */
    public function setSubdivisions($subdivisions)
    {
        $this->subdivisions = $subdivisions;

        return $this;
    }

}