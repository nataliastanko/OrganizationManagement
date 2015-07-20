<?php

namespace Organization\ManagementBundle\Twig;

use Doctrine\ORM\EntityManager;

class MenuExtension extends \Twig_Extension
{

    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('allCities', array($this, 'getCities'))
        );
    }

    /*
     * Get cities to menu
     */
    public function getCities(){
        $cities = $this->em->getRepository('OrganizationManagementBundle:City')->findAll();
        return $cities;
    }

    public function getName()
    {
        return 'management_menu_extension';
    }

}
