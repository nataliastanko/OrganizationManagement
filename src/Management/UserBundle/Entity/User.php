<?php

namespace Management\UserBundle\Entity;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 * @UniqueEntity(fields="email", message="error.user.email.taken")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="phone_number", type="string", nullable=true)
     * Assert\NotBlank(message = "error.user.phone_number.not_blank", groups={"settings"})
     * @Assert\Regex(
     *  pattern= "/([0-9\-\+\s])?/",
     *  match = true,
     *  message = "error.user.phone_number.regex_not_match",
     *  groups={"settings"}
     * )
     */
    protected $phoneNumber;

    /**
     * Set phoneNumber
     *
     * @param string $phoneNumber
     *
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * Get phoneNumber
     *
     * @return string
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    public function __construct()
    {
        parent::__construct();
    }
}
