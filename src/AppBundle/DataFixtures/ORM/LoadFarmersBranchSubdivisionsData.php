<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\DataFixtures\SubdivisionsFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadFarmersBranchSubdivisionsData extends SubdivisionsFixture
{

    protected $subs = [
        'Brookhaven',
        'Town North Estates',
        'Valwood Park',
    ];

    function getCityName()
    {
        return "Farmers Branch";
    }

}