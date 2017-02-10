<?php namespace AppBundle\DataFixtures;


use AppBundle\Entity\City;
use AppBundle\Entity\Subdivision;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class SubdivisionsFixture implements FixtureInterface, OrderedFixtureInterface
{
    protected $subs = [];

    /**
     * @return string
     */
    abstract function getCityName();

    public function load(ObjectManager $manager)
    {
        $cityRepo = $manager->getRepository(City::class);

        $city = $cityRepo->findOneByName($this->cityName);

        foreach ($this->subs as $subName) {
            $sub = new Subdivision();
            $sub->setName($subName);
            $sub->setCity($city);

            $manager->persist($sub);
        }

        $manager->flush();

    }

    public function getOrder()
    {
        return 2;
    }


}