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
     * @var string
     * @Assert\NotBlank(message = "error.user.name.not_blank", groups={"settings"})
     * @ORM\Column(name="name", type="string", length=100, nullable=true)
     */
    private $name;

    /**
     * @var string
     * @Assert\NotBlank(message = "error.user.last_name.not_blank", groups={"settings"})
     * @ORM\Column(name="last_name", type="string", length=100, nullable=true)
     */
    private $lastName;

    /**
     * @var string
     *
     * @Assert\NotBlank(message = "error.user.phone_number.not_blank", groups={"settings"})
     * Assert\Regex(
     *  pattern= "/([0-9\-\+\s])?/",
     *  match = true,
     *  message = "error.user.phone_number.regex_not_match",
     *  groups={"settings"}
     * )
     * @ORM\Column(name="phone_number", type="string", nullable=true, nullable=true)
     *
     */
    protected $phoneNumber;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Set name
     *
     * @param string $name
     * @return User
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set last name
     *
     * @param string $lastName
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get last name
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

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

}
