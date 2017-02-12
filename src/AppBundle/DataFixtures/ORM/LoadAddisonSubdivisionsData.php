<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\DataFixtures\SubdivisionsFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadAddisonSubdivisionsData extends SubdivisionsFixture
{

    protected $subs = [
        'Addison Place',
        'Grand Addison',
        'Midway Meadows',
        'Oaks North',
        'Waterford',
    ];

    function getCityName()
    {
        return "Addison";
    }

}