<?php 

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\City;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadCityData implements FixtureInterface 
{
    protected $cities = [
        'Allen' => 51,
        'Addison' => 10,
        'Carrollton' => 22,
        'Coppell' => 31,
        'Corinth' => 31,
        'Denton' => 31,
        'Farmers Branch' => 22,
        'Flower Mound' => 31,
        'Frisco' => 55,
        'Garland' => 24,
        'Grapevine' => 5,
        'Highland Village' => 22,
        'Lewisville' => 41,
        'Little Elm' => 31,
        'McKinney' => 53,
        'Mesquite' => 5,
        'Plano' => 20,
        'Richardson' => 23,
        'Rockwall' => 34,
        'Rowlett' => 8,
        'The Colony' => 9,

    ];
    
    public function load(ObjectManager $manager)
    {
        foreach ($this->cities as $name => $mls) {
            $city = new City();
            $city->setName($name)->setMls($mls);

            $manager->persist($city);
        }

        $manager->flush();
    }

}