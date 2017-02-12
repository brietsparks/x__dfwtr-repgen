<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\DataFixtures\SubdivisionsFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadDentonSubdivisionsData extends SubdivisionsFixture
{

    protected $subs = [
        'Bellaire',
        'Bent Creek Estates',
        'Meadows at Hickory Creek',
        'Hickory Creek Ranch',
        'Pecan Creek',
        'Robinson Oaks',
        'Robson Ranch',
        'Southridge Estates',
        'Summit Oaks',
        'Sundown Ranch',
        'The Preserve at Pecan Creek',
        'The Vintage',
        'Thistle Hill',
        'Villages Of Carmel',
    ];

    function getCityName()
    {
        return "Denton";
    }

}