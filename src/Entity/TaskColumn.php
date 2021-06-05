<?php

namespace App\Entity;

use App\Repository\TaskColumnRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\TaskSwimlane;

/**
 * @ORM\Entity(repositoryClass=TaskColumnRepository::class)
 */
class TaskColumn
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $position;

    /**
     * @ORM\ManyToOne(targetEntity=TaskSwimlane::class, inversedBy="taskColumns")
     * @ORM\JoinColumn(name="swimlane_id", referencedColumnName="id")
     */
    private $swimlaneId;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPosition(): ?int
    {
        return $this->position;
    }

    public function setPosition(int $position): self
    {
        $this->position = $position;

        return $this;
    }

    public function getSwimlaneId(): ?TaskSwimlane
    {
        return $this->swimlaneId;
    }

    public function setSwimlaneId(?TaskSwimlane $swimlaneId): self
    {
        $this->swimlaneId = $swimlaneId;

        return $this;
    }
}
