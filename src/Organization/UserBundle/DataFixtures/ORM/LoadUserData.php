<?php

namespace Organization\UserBundle\FataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Organization\UserBundle\Entity\User;

class LoadUserData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $userAdmin = new User();
        $userAdmin->setUsername('nataliastanko');
        $userAdmin->setEmail('contact@nataliastanko.com');
        $userAdmin->setPlainPassword('123');
        $userAdmin->addRole('ROLE_ADMIN');
        $userAdmin->setEnabled(true);

        $manager->persist($userAdmin);
        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 2; // the order in which fixtures will be loaded
    }

}
