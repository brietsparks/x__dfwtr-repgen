<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\DataFixtures\SubdivisionsFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadGarlandSubdivisionsData extends SubdivisionsFixture
{

    protected $subs = [
        'Camelot',
        'Carriagehouse Estates',
        'Castlewood',
        'Club Hill Estates',
        'Glenbrook Meadows',
        'Golden Meadows',
        'Greens',
        'Herons Bay',
        'Holiday Park North',
        'La Prada',
        'Meadowcreek Park',
        'Meadowood',
        'Mill Creek',
        'Monica Park',
        'North Star West Estates',
        'Northlake Estates',
        'Oakridge',
        'Orchard Hills Estates',
        'Provence At Firewheel',
        'Ridgewood Estates',
        'Ridgewood Park',
        'Shores Of Eastern Hills',
        'Skillman Forest',
        'Springpark Central',
        'Villages Of Valley Creek',
        'Williams Estates',
    ];

    function getCityName()
    {
        return "Garland";
    }

}