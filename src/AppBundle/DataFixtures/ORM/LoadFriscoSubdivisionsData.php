<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\DataFixtures\SubdivisionsFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadFriscoSubdivisionsData extends SubdivisionsFixture
{

    protected $subs = [
        'Austin Ridge At Lonestar Ranch',
        'Chapel Creek',
        'Christie Ranch',
        'Trails',
        'Creekside At Preston',
        'Stonebriar',
        'Crown Ridge',
        'Cypress Creek',
        'Panther Creek',
        'Eldorado Fairways',
        'Cobb Hill',
        'Legacy',
        'Fairways',
        'Frisco Lakes',
        'Grayhawk',
        'Griffin Parc',
        'Heather Ridge',
        'Heritage Green',
        'Heritage Lakes',
        'Heritage Village',
        'Hidden Cove',
        'Hillcrest Estates',
        'Hunters Creek',
        'Knolls Of Frisco',
        'Preston Vineyards',
        'Meadow Creek',
        'Meadow Hill',
        'Meadows Of Preston',
        'Miramonte',
        'Newman Village',
        'Northridge',
        'Park Place',
        'Pearson Farms',
        'Plantation Estates',
        'Plantation Resort',
        'Prestmont',
        'Preston Gables',
        'Preston Highlands',
        'Preston Lakes',
        'Preston Ridge',
        'Quail Meadow',
        'Queens Gate',
        'Saddlebrook Village',
        'Shaddock Creek',
        'Waterstone',
        'Starwood',
        'Stewart Creek',
        'Stone Creek Village',
        'Stonebrook',
        'Stonelake Estates',
        'Stonewater Crossing',
        'Turnbridge Manor',
        'Willow Bay',
        'Waterford Falls',
        'Westfalls Village',
        'Willow Pond',
        'Winding Creek',
    ];

    function getCityName()
    {
        return "Frisco";
    }

}