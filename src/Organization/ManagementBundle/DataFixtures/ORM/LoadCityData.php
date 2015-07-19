<?php

namespace Organization\ManagementBundle\FataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Organization\ManagementBundle\Entity\City;

class LoadUserData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $city1 = new City();
        $city1->setName('Kraków');
        $city1->setEmail('krakow@womenintechnology.pl');
        $manager->persist($city1);

        $city2 = new City();
        $city2->setName('Katowice');
        $city2->setEmail('silesia@womenintechnology.pl');
        $manager->persist($city2);


        $city3 = new City();
        $city3->setName('Wrocław');
        $city3->setEmail('wroclaw@womenintechnology.pl');
        $manager->persist($city3);

        $city4 = new City();
        $city4->setName('Warszawa');
        $city4->setEmail('warszawa@womenintechnology.pl');
        $manager->persist($city4);

        // $city5 = new City();
        // $city5->setName('Gliwice');
        // $city5->setEmail('silesia@womenintechnology.pl');
        // $manager->persist($city5);

        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 1; // the order in which fixtures will be loaded
    }

}
