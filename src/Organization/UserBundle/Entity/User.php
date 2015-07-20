<?php

namespace Organization\UserBundle\Entity;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

use Gedmo\Timestampable\Traits\TimestampableEntity;
use Gedmo\Blameable\Traits\BlameableEntity;
use Gedmo\Mapping\Annotation as Gedmo;

use FOS\UserBundle\Model\User as BaseUser;

use Doctrine\ORM\Mapping as ORM;

use Organization\ManagementBundle\Entity\City;

use Misd\PhoneNumberBundle\Validator\Constraints\PhoneNumber as AssertPhoneNumber;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 * @Gedmo\Loggable
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 * @UniqueEntity(fields="email", message="error.user.email.taken", groups={"settings"})
 * @UniqueEntity(fields="url", message="error.user.url.taken", groups={"settings"})
 * @UniqueEntity(fields="phoneNumber", message="error.user.phoneNumber.taken", groups={"settings"})
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
     * Hook timestampable behavior
     * updates createdAt, updatedAt fields
     */
    use TimestampableEntity;

    /**
     * Hook blameable behavior
     * updates createdBy, updatedBy fields
     */
    use BlameableEntity;

    /**
     * @ORM\Column(name="deletedAt", type="datetime", nullable=true)
     */
    private $deletedAt;

    /**
     * @var string
     * @Assert\NotBlank(message = "error.user.name.notBlank", groups={"settings"})
     * @ORM\Column(name="name", type="string", length=100, nullable=true)
     */
    private $name;

    /**
     * @var string
     * @Assert\NotBlank(message = "error.user.lastName.notBlank", groups={"settings"})
     * @ORM\Column(name="last_name", type="string", length=100, nullable=true)
     */
    private $lastName;

    /**
     * @var string
     * @Gedmo\Versioned
     * @Assert\Url(
     *    message = "error.url.not_match",
     *    protocols = {"http", "https"},
     *    checkDNS = true,
     *    groups={"settings"}
     * )
     * @ORM\Column(name="url", type="string", length=255, nullable=true)
     */
    private $url;

    /**
     * @var string
     * @Assert\NotBlank(message = "error.phoneNumber.notBlank", groups={"settings"})
     * @AssertPhoneNumber(message = "error.phoneNumber.notMatch", groups={"settings"})
     * @ORM\Column(name="phone_number", type="phone_number", nullable=true)
     */
    protected $phoneNumber;

    /**
     * @Gedmo\Versioned
     * @Assert\NotBlank(message = "error.city.notBlank", groups={"settings"})
     * @ORM\ManyToOne(targetEntity="Organization\ManagementBundle\Entity\City", inversedBy="users")
     * @ORM\JoinColumn(name="city_id", referencedColumnName="id")
     **/
    private $city;

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
     * @return User
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

    /**
     * Set url
     *
     * @param string $resources
     * @return User
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set resources
     *
     * @param string $city
     * @return Partner
     */
    public function setCity(City $city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return City
     */
    public function getCity()
    {
        return $this->city;
    }

}
