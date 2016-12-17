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
        'Anna'  => 21,
        'Aubrey' => 31,
        'Blueridge'  => 67,
        'Carrollton' => 22,
        'Celina'  => 60,
        'Coppell' => 31,
        'Corinth' => 31,
        'Denton' => 31,
        'Fairview'  => 52,
        'Farmers Branch' => 22,
        'Farmersville'  => 58,
        'Flower Mound' => 31,
        'Frisco' => 55,
        'Garland' => 24,
        'Grapevine' => 5,
        'Highland Village' => 22,
        'Irving'  => 54,
        'Lavon'  => 56,
        'Lewisville' => 41,
        'Little Elm' => 31,
        'Lucas' => 52,
        'McKinney' => 53,
        'Melissa'  => 68,
        'Mesquite' => 5,
        'Nevada' => 56,
        'Plano' => 20,
        'Pilot Point' => 31,
        'Prosper'  => 59,
        'Richardson' => 23,
        'Rockwall' => 34,
        'Rowlett' => 8,
        'Sachse' => 8,
        'Sherman'  => 37,
        'The Colony' => 9,
        'Dallas' => null,
        'Wylie'  => 50,
    ];

    protected $subCities = [
        'Park Cities' => 25,
        'Dallas White Rock'  => 12,
        'Dallas Uptown'  => 17,
        'Dallas Northwest'  => 16,
        'Lake Highlands'  => 18,
        'Dallas North'  => 11,
    ];

    public function load(ObjectManager $manager)
    {
        // load all cities with MLS
        foreach ($this->getCities() as $name => $mls) {
            $city = new City();
            $city->setName($name)->setMls($mls);

            $manager->persist($city);
        }

        $manager->flush();

        // set the parent/child cities
        foreach ($this->subCities as $name => $mls) {
            $repo = $manager->getRepository(City::class);
            $city = $repo->findOneByName($name);

            $dallas = $repo->findOneByName('Dallas');
            $city->setParent($dallas);

            $manager->persist($city);
        }

        $manager->flush();
    }

    protected function getCities()
    {
        return array_merge($this->cities, $this->subCities);
    }

}