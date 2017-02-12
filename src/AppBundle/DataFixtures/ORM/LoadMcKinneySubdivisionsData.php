<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\DataFixtures\SubdivisionsFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadMcKinneySubdivisionsData extends SubdivisionsFixture
{

    protected $subs = [
        'Stonebridge',
        'Autumn Ridge',
        'Avalon',
        'Boardwalk',
        'Brookstone',
        'Brookview',
        'College',
        'Craig Ranch',
        'Creekview Estates',
        'Eldorado Estates',
        'Eldorado Heights',
        'Fairways North At Westridge',
        'Fairways West At Westridge',
        'Fairway Village',
        'Falcon Creek',
        'Fieldstone Place',
        'Forest Ridge',
        'Fountainview',
        'Hackberry Ridge',
        'Harvest Bend',
        'Heritage Bend',
        'Hidden Creek',
        'Kensington Creek',
        'Lacima Manor',
        'Legends Of Mckinney',
        'Mallard Lakes',
        'North Brook',
        'Pine Ridge Estates',
        'Ridgecrest',
        'Ridge Road Estates',
        'Seville Of Highlands',
        'Stone Brooke Crossing',
        'Stonegate',
        'Timber Creek',
        'Tucker Hill',
        'Village Creek',
        'Village Of Eldorado',
        'Village Park',
        'Villas Of Westridge',
        'Virginia Parklands',
        'Waterside',
        'Westridge On Fairways',
        'Wildwood Crossing',
        'Winsor Meadows At Westridge',
        'Wyndfield',
        'Wynngate',
    ];

    function getCityName()
    {
        return "McKinney";
    }

}