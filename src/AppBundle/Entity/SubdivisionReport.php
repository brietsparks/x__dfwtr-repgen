<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="subdivision_report")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SubdivisionRepository")
 */
class SubdivisionReport
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
    protected $subdivision;

}