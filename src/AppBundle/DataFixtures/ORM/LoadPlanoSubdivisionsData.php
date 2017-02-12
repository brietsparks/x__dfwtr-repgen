<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\DataFixtures\SubdivisionsFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadPlanoSubdivisionsData extends SubdivisionsFixture
{

    protected $subs = [
        'Briarmeade',
        'Chase Oaks Village',
        'Cross Creek',
        'Deerfield',
        'Pasquinellis Willow Crest',
        'Forest Creek',
        'Russell Creek',
        'Forest Creek Estates',
        'Gleneagles',
        'Prestonwood',
        'Spring Creek',
        'Hunters Glen',
        'Hunters Landing',
        'Hunters Ridge',
        'Lakeside On Preston',
        'Los Rios',
        'Old Shepard Place',
        'Parker Road Estates West',
        'Ridgeview',
        'Ridgewood',
        'Shoal Creek',
        'Spring Creek Parkway Estates',
        'Stoney Hollow',
        'Willow Bend',
        'Town West',
        'Trails Of Glenwood',
        'Village At Legacy',
        'Villages Of White Rock Creek',
        'Whiffletree',
        'Wolf Creek Estates',
    ];

    function getCityName()
    {
        return "Plano";
    }

}