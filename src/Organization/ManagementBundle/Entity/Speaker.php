<?php

namespace Organization\ManagementBundle\Entity;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

use Gedmo\Timestampable\Traits\TimestampableEntity;
use Gedmo\Blameable\Traits\BlameableEntity;
use Gedmo\Mapping\Annotation as Gedmo;

use Doctrine\ORM\Mapping as ORM;

use Misd\PhoneNumberBundle\Validator\Constraints\PhoneNumber as AssertPhoneNumber;

/**
 * Speaker
 *
 * @ORM\Table(name="speakers")
 * @ORM\Entity
 * @Gedmo\Loggable
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 * @UniqueEntity(fields="email", message="error.speaker.email.taken", groups={"settings"})
 * @UniqueEntity(fields="url", message="error.speaker.url.taken", groups={"settings"})
 * @UniqueEntity(fields="phoneNumber", message="error.speaker.phoneNumber.taken", groups={"settings"})
 */
class Speaker
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
     * @Assert\Url(
     *    message = "error.url.not_match",
     *    protocols = {"http", "https"},
     *    checkDNS = true
     * )
     * @ORM\Column(name="url", type="string", length=255, nullable=true)
     */
    private $url;

    /**
     * @var string
     * @Gedmo\Versioned
     * @ORM\Column(name="last_name", type="string", length=255)
     */
    private $lastName;

    /**
     * @var string
     * @Gedmo\Versioned
     * @ORM\Column(name="bio", type="text", nullable=true)
     */
    private $bio;

    /**
     * @var string
     * @Gedmo\Versioned
     * @ORM\Column(name="photo", type="string", length=255, nullable=true)
     */
    private $photo;

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
     * @ORM\OneToMany(targetEntity="Topic", mappedBy="speaker")
     **/
    private $topics;

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
     * Get topics
     *
     * @return ArrayCollection
     */
    public function getTopics()
    {
        return $this->topics;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Speaker
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
     * @return Speaker
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
     * Set bio
     *
     * @param string $bio
     * @return Speaker
     */
    public function setBio($bio)
    {
        $this->bio = $bio;

        return $this;
    }

    /**
     * Get bio
     *
     * @return string
     */
    public function getBio()
    {
        return $this->bio;
    }

    /**
     * Set photo
     *
     * @param string $photo
     * @return Speaker
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set phoneNumber
     *
     * @param string $phoneNumber
     * @return Speaker
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
     * @return Speaker
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
     * @return Speaker
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
     * @return Speaker
     */
    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

}
