<?php

namespace Organization\ManagementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

use Gedmo\Timestampable\Traits\TimestampableEntity;
use Gedmo\Blameable\Traits\BlameableEntity;
use Gedmo\Mapping\Annotation as Gedmo;

use Organization\ManagementBundle\Entity\City;

use Misd\PhoneNumberBundle\Validator\Constraints\PhoneNumber as AssertPhoneNumber;

/**
 * Helper
 *
 * @ORM\Table(name="helpers")
 * @ORM\Entity
 * @Gedmo\Loggable
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 * @UniqueEntity(fields="email", message="error.helper.email.taken", groups={"settings"})
 * @UniqueEntity(fields="url", message="error.helper.url.taken", groups={"settings"})
 * @UniqueEntity(fields="phoneNumber", message="error.helper.phoneNumber.taken", groups={"settings"})
 */
class Helper
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

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
     * @Gedmo\Versioned
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     * @Gedmo\Versioned
     * @ORM\Column(name="last_name", type="string", length=255)
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
     * @Gedmo\Versioned
     * @AssertPhoneNumber(message = "error.phoneNumber.notMatch", groups={"settings"})
     * @ORM\Column(name="phone_number", type="phone_number", nullable=true)
     */
    private $phoneNumber;

    /**
     *
     * @var string $email
     * @Gedmo\Versioned
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     * @Assert\Email(message = "error.email.notMatch", groups={"settings"})
     */
    protected $email;

    /**
     * @var string
     * @Gedmo\Versioned
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @Assert\Count(
     *      min = "1",
     *      minMessage = "error.cities.notBlank",
     *      groups={"settings"}
     * )
     * @ORM\ManyToMany(targetEntity="City", inversedBy="helpers")
     * @ORM\JoinTable(name="helpers_city")
     **/
    private $cities;

    public function __construct() {
        $this->cities = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Helper
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
     * Set lastName
     *
     * @param string $lastName
     * @return Helper
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Helper
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set phoneNumber
     *
     * @param string $phoneNumber
     * @return Helper
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
     * Set email
     *
     * @param string  $email
     * @return Helper
     */
    public function setEmail( $email ) {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * Set url
     *
     * @param string $resources
     * @return Helper
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
     * Get deletedAt
     *
     * @return DateTime
     */
    public function getDeletedAt() {
        return $this->deletedAt;
    }

    /**
     * Set deletedAt
     *
     * @param string $deletedAt
     * @return Helper
     */
    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    /**
     * Get cities
     *
     * @return array
     */
    public function getCities()
    {
        return $this->cities;
    }

    public function addCity(City $city)
    {
        $tag->addCity($this); // synchronously updating inverse side
        $this->cities[] = $city;
    }

}
