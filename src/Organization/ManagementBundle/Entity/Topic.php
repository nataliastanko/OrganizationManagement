<?php

namespace Organization\ManagementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;

use Gedmo\Timestampable\Traits\TimestampableEntity;
use Gedmo\Blameable\Traits\BlameableEntity;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Topic
 *
 * @ORM\Table(name="topics")
 * @ORM\Entity
 * @Gedmo\Loggable
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 */
class Topic
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
     * @Assert\NotBlank(message = "error.topic.lastname.notBlank", groups={"settings"})
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     * @Gedmo\Versioned
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @Gedmo\Versioned
     * @Assert\NotBlank(message = "error.topic.speaker.notBlank", groups={"settings"})
     * @ORM\ManyToOne(targetEntity="Speaker", inversedBy="topics")
     * @ORM\JoinColumn(name="speaker_id", referencedColumnName="id")
     **/
    private $speaker;

    /**
     * @ORM\ManyToMany(targetEntity="Meeting", mappedBy="topics")
     **/
    private $meetings;

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
     * Get speaker
     *
     * @return Speaker
     */
    public function getSpeaker()
    {
        return $this->speaker;
    }

    /**
     * Set speaker
     *
     * @param Speaker $speaker
     * @return Topic
     */
    public function setSpeaker($speaker)
    {
        $this->speaker = $speaker;

        return $this;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Topic
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
     * @return Topic
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
     * @return Topic
     */
    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    /**
     * Get topic name with speaker name
     *
     * @return topic fullname
     */
    public function getFullname()
    {
        return $this->name. ' - '. $this->getSpeaker()->getFullname();
    }

}
