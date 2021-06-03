<?php

namespace App\Entities;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="task")
 */
class ToDo
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $title;

    /**
     * @ORM\Column(type="string")
     */
    protected $description;

    /**
     * @ORM\Column(name="finished", type="integer")
     */
    protected $finished;

    /**
     * @ORM\Column(name="created", type="datetime", nullable=false)
     * @Gedmo\Timestampable(on="create")
     * @var DateTime
     */
    protected $created;

    /**
     * @var DateTime
     * @ORM\Column(name="updated", type="datetime", nullable=false)
     * @Gedmo\Timestampable(on="update")
     */
    protected $updated;

    public function __construct($title = null, $description = null)
    {
        $this->title = $title;
        $this->description = $description;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getFinished()
    {
        return $this->finished;
    }

    public function setFinished($finished)
    {
        $this->finished = $finished;
    }

    /**
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created->format('Y-m-d H:i:s');
    }

    /**
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated->format('Y-m-d H:i:s');
    }
}
