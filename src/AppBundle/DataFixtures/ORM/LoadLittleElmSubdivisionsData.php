<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\DataFixtures\SubdivisionsFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadLittleElmSubdivisionsData extends SubdivisionsFixture
{

    protected $subs = [
        'Bay Ridge Estates',
        'Cottonwood Point',
        'Eldorado Estates',
        'Frisco Ranch',
        'Glen Cove',
        'Knob Hill Lake Estates',
        'Lakewood Estates',
        'Marina Vista Estates',
        'Mariner Pointe',
        'Paloma Creek',
        'Robinson Ridge',
        'Shell Beach',
        'Stardust Ranch',
        'Sunset Pointe',
        'Wellington Trace',
        'Woodlake West',
        'Wynfield Farms',
    ];

    function getCityName()
    {
        return "Little Elm";
    }

}