<?php

namespace Organization\EnrollmentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Question
 *
 * @ORM\Table(name="questions")
 * @ORM\Entity
 */
class Question
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
     *
     * @ORM\Column(name="name", type="text")
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="helpblock", type="string", length=255, nullable=true)
     */
    private $helpblock;

    /**
     * @ORM\OneToMany(targetEntity="Answer", mappedBy="question")
     **/
    private $answers;

    public function getAnswers()
    {
        return $this->answers;
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
     * @return Question
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
     * Set helpblock
     *
     * @param string $helpblock
     * @return Question
     */
    public function setHelpblock($helpblock)
    {
        $this->helpblock = $helpblock;

        return $this;
    }

    /**
     * Get helpblock
     *
     * @return string
     */
    public function getHelpblock()
    {
        return $this->helpblock;
    }
}
