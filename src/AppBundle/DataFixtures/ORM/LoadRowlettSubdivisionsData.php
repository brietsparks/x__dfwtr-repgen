<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\DataFixtures\SubdivisionsFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadRowlettSubdivisionsData extends SubdivisionsFixture
{

    protected $subs = [
        'College Park',
        'Flower Hill',
        'Highland Meadows North',
        'Highland Meadows',
        'Kenwood Heights',
        'Lake Bend',
        'Lake Valley',
        'Lakecrest',
        'Lakehill',
        'Lakeshore Park',
        'Lakeview Meadow',
        'Lakewood',
        'Peninsula',
        'Princeton Park',
        'Princeton Pointe',
        'Ridgecrest',
        'Spinnaker Cove',
        'Springfield',
        'Toler Bay',
        'Toler Ridge',
        'Waterview',
        'Westwood Estates',
        'Westwood Shores',
        'Westwood',
    ];

    function getCityName()
    {
        return "Rowlett";
    }

}