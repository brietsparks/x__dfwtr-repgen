<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\DataFixtures\SubdivisionsFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadAllenSubdivisionsData extends SubdivisionsFixture
{

    protected $subs = [
        'Allen North',
        'Avondale',
        'Bellegrove',
        'Bethany Creek Estates',
        'Bridgewater Crossing',
        'Brookside',
        'Collin Square',
        'Cumberland Crossing',
        'Custer Meadows',
        'Fountain Park',
        'Glendover Park',
        'Greengate',
        'Hillside Village',
        'Lost Creek Ranch',
        'Maxwell Creek',
        'Montgomery Farm',
        'Morningside',
        'Oak Ridge',
        'Orchards',
        'Parkside',
        'Quail Run',
        'Raintree Estates',
        'Reid Farm',
        'Saddleridge',
        'Shaddock Park',
        'Silhouette',
        'Spring Meadow',
        'Summerfield',
        'Suncreek',
        'Country Meadow',
        'Twin Creeks',
        'Waterford Crossing',
        'Waterford Park',
        'Waterford Trails',
        'Watters Crossing',
        'Windridge',
    ];

    function getCityName()
    {
        return "Allen";
    }

}