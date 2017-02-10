<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\DataFixtures\SubdivisionsFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadCarrolltonSubdivisionsData extends SubdivisionsFixture
{

    protected $subs = [
        'Arbor Creek',
        'Austin Waters',
        'Booth Creek',
        'Carillon Hills',
        'High Country',
        'Homestead At Carrollton',
        'Kingspoint',
        'Moore Farm',
        'Nob Hill',
        'Oak Hills',
        'Rosemeade',
        'Indian Creek',
        'Palisades',
        'Trafalgar Square',
    ];

    function getCityName()
    {
        return "Carrollton";
    }

}