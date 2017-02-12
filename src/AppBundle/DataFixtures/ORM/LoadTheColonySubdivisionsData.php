<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\DataFixtures\SubdivisionsFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadTheColonySubdivisionsData extends SubdivisionsFixture
{

    protected $subs = [
        'Stewart Peninsula',
        'The Legends',
        'Tribute',
        'Northpointe',
        'Ridgepointe',
        'Colony',
    ];

    function getCityName()
    {
        return "The Colony";
    }

}