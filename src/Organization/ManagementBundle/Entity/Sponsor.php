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

/**
 * Sponsor
 *
 * @ORM\Table(name="sponsors")
 * @ORM\Entity
 * @Gedmo\Loggable
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 * @UniqueEntity(fields="name", message="error.sponsor.name.taken")
 * @UniqueEntity(fields="email", message="error.sponsor.name.taken")
 * @UniqueEntity(fields="url", message="error.sponsor.url.taken")
 * @UniqueEntity(fields="phoneNumber", message="error.sponsor.phoneNumber.taken")
 */
class Sponsor
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
     *
     * @var string $email
     * @Gedmo\Versioned
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     * @Assert\Email(message = "error.user.email.email_not_match", groups={"settings"})
     */
    protected $email;

    /**
     * @var string
     * @Gedmo\Versioned
     * @Assert\Url(
     *    message = "error.url.not_match",
     *    protocols = {"http", "https"},
     *    checkDNS = true
     * )
     * @ORM\Column(name="url", type="string", length=255)
     */
    private $url;

    /**
     * @var string
     * @Gedmo\Versioned
     * Assert\NotBlank(message = "error.user.phone_number.not_blank", groups={"settings"})
     * Assert\Regex(
     *  pattern= "/([0-9\-\+\s])?/",
     *  match = true,
     *  message = "error.user.phone_number.regex_not_match",
     *  groups={"settings"}
     * )
     * @ORM\Column(name="phone_number", type="string", length=255, nullable=true)
     */
    private $phoneNumber;

    /**
     * @var string
     * @Gedmo\Versioned
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="resources", type="text", nullable=true)
     */
    private $resources;

    /**
     * @ORM\ManyToMany(targetEntity="City", inversedBy="sponsors")
     * @ORM\JoinTable(name="sponsors_city")
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
     * @return Sponsor
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
     * Set description
     *
     * @param string $description
     * @return Sponsor
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
     * Set resources
     *
     * @param string $resources
     * @return Sponsor
     */
    public function setResources($resources)
    {
        $this->resources = $resources;

        return $this;
    }

    /**
     * Get resources
     *
     * @return string
     */
    public function getResources()
    {
        return $this->resources;
    }

    /**
     * Set url
     *
     * @param string $resources
     * @return Sponsor
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Set email
     *
     * @param string  $email
     * @return Sponsor
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
     * Set phoneNumber
     *
     * @param string $phoneNumber
     * @return Sponsor
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
     * @return Sponsor
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
