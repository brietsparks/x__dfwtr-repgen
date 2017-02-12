<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\DataFixtures\SubdivisionsFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadGrapevineSubdivisionsData extends SubdivisionsFixture
{

    protected $subs = [
        'Dove Crossing',
        'Glade Crossing',
        'Lakeside Estate',
        'Oak Creek Estate',
        'Shadow Glen',
        'Silver Lake Estates',
        'Trail Lake',
        'Western Oaks',
        'Western Oaks Estate',
    ];

    function getCityName()
    {
        return "Grapevine";
    }

}