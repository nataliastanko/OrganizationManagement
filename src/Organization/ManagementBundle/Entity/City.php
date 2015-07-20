<?php

namespace Organization\ManagementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

use Gedmo\Timestampable\Traits\TimestampableEntity;
use Gedmo\Blameable\Traits\BlameableEntity;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * City
 *
 * @ORM\Table(name="cities")
 * @ORM\Entity
 * @Gedmo\Loggable
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 * @UniqueEntity(fields="name", message="error.city.name.taken", groups={"settings"})
 * @UniqueEntity(fields="email", message="error.city.email.taken", groups={"settings"})
 */
class City
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
     * @ORM\Column(name="deletedAt", type="datetime", nullable=true)
     */
    private $deletedAt;

    /**
     * @var string
     * @Gedmo\Versioned
     * @Assert\Email(message = "error.city.name.notBlank", groups={"settings"})
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     *
     * @var string $email
     * @Gedmo\Versioned
     * @Assert\Email(message = "error.email.notMatch", groups={"settings"})
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    protected $email;

    /**
     * @ORM\OneToMany(targetEntity="Organization\UserBundle\Entity\User", mappedBy="city")
     **/
    private $users;

    /**
     * @ORM\OneToMany(targetEntity="Meeting", mappedBy="city")
     **/
    private $meetings;

    /**
     * @ORM\OneToMany(targetEntity="Place", mappedBy="city")
     **/
    private $places;

    /**
     * @ORM\ManyToMany(targetEntity="Sponsor", mappedBy="cities")
     **/
    private $sponsors;

    /**
     * @ORM\ManyToMany(targetEntity="Helper", mappedBy="cities")
     **/
    private $helpers;

    /**
     * @ORM\ManyToMany(targetEntity="Partner", mappedBy="cities")
     **/
    private $partners;

    public function __construct() {
        $this->users = new ArrayCollection();
        $this->meetings = new ArrayCollection();
        $this->places = new ArrayCollection();
        $this->sponsor = new ArrayCollection();
        $this->helpers = new ArrayCollection();
        $this->partners = new ArrayCollection();
    }

    /**
     * ORM\ManyToMany
     **/
    // private $topics;

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
     * @return City
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
     * Set email
     *
     * @param string  $email
     * @return City
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
     * @return City
     */
    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    /**
     * Get users
     *
     * @return ArrayCollection
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * Get places
     *
     * @return ArrayCollection
     */
    public function getPlaces()
    {
        return $this->palces;
    }

    /**
     * Get helpers
     *
     * @return array
     */
    public function getHelpers()
    {
        return $this->helpers;
    }

    /**
     * Get partners
     *
     * @return array
     */
    public function getPartners()
    {
        return $this->partners;
    }

    /**
     * Get sponsors
     *
     * @return array
     */
    public function getSponsors()
    {
        return $this->sponsors;
    }

    /**
     * Get meetings
     *
     * @return ArrayCollection
     */
    public function getMeetings()
    {
        return $this->meetings;
    }

}
