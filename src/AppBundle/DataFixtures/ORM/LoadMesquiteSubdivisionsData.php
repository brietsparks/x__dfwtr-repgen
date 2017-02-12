<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\DataFixtures\SubdivisionsFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadMesquiteSubdivisionsData extends SubdivisionsFixture
{

    protected $subs = [
        'Broadmoor',
        'Casa Terrace',
        'Club Estates',
        'Country Club Estates',
        'Country Meadow',
        'Creek Crossing',
        'East Glen',
        'Echelon Mission Ranch',
        'Edgemont Park',
        'Hills At Tealwood',
        'Los Altos',
        'Meadow Creek',
        'Meadowdale',
        'Meadowview Farms',
        'Mesquite Park',
        'Northridge Estates',
        'Palos Verdes',
        'Parkview',
        'Pecan Creek',
        'Quail Hollow',
        'Skyline',
        'Town East Estates',
        'Valleycreek',
        'Willow Glen',
    ];

    function getCityName()
    {
        return "Mesquite";
    }

}