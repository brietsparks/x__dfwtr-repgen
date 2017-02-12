<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\DataFixtures\SubdivisionsFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadRichardsonSubdivisionsData extends SubdivisionsFixture
{

    protected $subs = [
        'Azalea Park',
        'Breckinridge',
        'Canyon Creek',
        'Creek Hollow',
        'Greenwood Hills',
        'Heather Ridge Estates',
        'Northrich',
        'Parkview Estates',
        'Prairie Creek',
        'Richardson Heights',
        'Springpark',
        'Woods Of Springcreek',
    ];

    function getCityName()
    {
        return "Richardson";
    }

}