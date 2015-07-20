<?php

namespace Organization\ManagementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use Symfony\Component\Validator\Constraints as Assert;

use Gedmo\Timestampable\Traits\TimestampableEntity;
use Gedmo\Blameable\Traits\BlameableEntity;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Meeting
 *
 * @ORM\Table(name="meetings")
 * @ORM\Entity
 * @Gedmo\Loggable
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 */
class Meeting
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
     * @var string
     * @Assert\NotBlank(message = "error.meeting.name.notBlank", groups={"settings"})
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(name="deletedAt", type="datetime", nullable=true)
     */
    private $deletedAt;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="tickets_url", type="string", length=255, nullable=true)
     */
    private $ticketsUrl;

    /**
     * @Gedmo\Versioned
     * @Assert\NotBlank(message = "error.city.notBlank", groups={"settings"})
     * @ORM\ManyToOne(targetEntity="City", inversedBy="meetings")
     * @ORM\JoinColumn(name="city_id", referencedColumnName="id")
     **/
    private $city;

    /**
     * @ORM\ManyToMany(targetEntity="Topic", inversedBy="meetings")
     * @ORM\JoinTable(name="meetings_topics")
     **/
    private $topics;

    /**
     * @ORM\ManyToMany(targetEntity="Partner", inversedBy="meetings")
     * @ORM\JoinTable(name="meetings_partners")
     **/
    private $partners;

    /**
     * @ORM\ManyToMany(targetEntity="Sponsor", inversedBy="meetings")
     * @ORM\JoinTable(name="meetings_sponsors")
     **/
    private $sponsors;

    public function __construct() {
        $this->topics = new ArrayCollection();
        $this->partners = new ArrayCollection();
        $this->sponsors = new ArrayCollection();
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
     * @return Meeting
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
     * @return Meeting
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
     * Set ticketsUrl
     *
     * @param string $ticketsUrl
     * @return Meeting
     */
    public function setTicketsUrl($ticketsUrl)
    {
        $this->ticketsUrl = $ticketsUrl;

        return $this;
    }

    /**
     * Get ticketsUrl
     *
     * @return string
     */
    public function getTicketsUrl()
    {
        return $this->ticketsUrl;
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
     * Set resources
     *
     * @param string $city
     * @return Place
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

    /**
     * Get topics
     *
     * @return array
     */
    public function getTopics()
    {
        return $this->topics;
    }

    /**
     * Get speakers
     *
     * @return array
     */
    public function getSepakers()
    {
        return $this->speakers;
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

}
