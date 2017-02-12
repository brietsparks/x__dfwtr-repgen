<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\DataFixtures\SubdivisionsFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadCorinthSubdivisionsData extends SubdivisionsFixture
{

    protected $subs = [
        'Creek Side',
        'Fairway Estates',
        'Oakmont',
    ];

    function getCityName()
    {
        return "Corinth";
    }

}