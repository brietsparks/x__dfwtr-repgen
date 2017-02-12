<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\DataFixtures\SubdivisionsFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadCoppellSubdivisionsData extends SubdivisionsFixture
{

    protected $subs = [
        'Braewood West',
        'Coppell Village',
        'Gibbs Station',
        'Huntington Ridge',
        'Lakewood Estates',
        'Meadows',
        'Northlake Woodlands',
        'Oakbend',
        'Pecan Hollow',
        'Raintree Village',
        'Riverchase Estates',
        'River Ridge',
        'Shadow Ridge Estates',
        'Villages Of Coppell',
        'Vistas Of Coppell',
        'Waterside Estates',
        'Willowood',
        'Woodridge',
    ];

    function getCityName()
    {
        return "Coppell";
    }

}