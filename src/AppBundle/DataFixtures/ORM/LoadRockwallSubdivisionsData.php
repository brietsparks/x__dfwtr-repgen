<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\DataFixtures\SubdivisionsFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadRockwallSubdivisionsData extends SubdivisionsFixture
{

    protected $subs = [
        'Caruth Lake',
        'Castle Ridge Estates',
        'Chandlers Landing',
        'Crestview',
        'Dalton Ranch',
        'Foxchase',
        'Hickory Ridge',
        'Highland Meadows',
        'Hillcrest Shores',
        'Lakeside Village',
        'Lakeview Summit',
        'Lofland',
        'Lynden Park Estates',
        'Meadowcreek Estates',
        'Northshore',
        'Preserve',
        'Promenade Harbor',
        'Rockwall Lake Estate',
        'Shores',
        'Shores North',
        'Stone Creek',
        'The Shores',
        'Turtle Cove',
        'Windmill Ridge Estates',
    ];

    function getCityName()
    {
        return "Rockwall";
    }

}