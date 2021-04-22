<?php

namespace App\Entity;

use App\Repository\TaskRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TaskRepository::class)
 */
class Task
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $title;

    /**
     * @ORM\ManyToOne(targetEntity=TaskPriority::class)
     * @ORM\Column(name="priority_id")
     */
    private $priorityId;

    /**
     * @ORM\ManyToOne(targetEntity=TaskColumn::class)
     * @ORM\Column(name="column_id")
     */
    private $columnId;

    /**
     * @ORM\ManyToOne(targetEntity=TaskSwimlane::class, inversedBy="tasks")
     * @ORM\JoinColumn(nullable=false)
     * @ORM\Column(name="swimlane_id")
     */
    private $swimlaneId;

    /**
     * @ORM\OneToMany(targetEntity=TaskComment::class, mappedBy="taskId", orphanRemoval=true)
     */
    private $taskComments;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $text;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumn(nullable=false)
     * @ORM\Column(name="owner_id")
     */
    private $ownerId;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\Column(name="executor_id")
     */
    private $executorId;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $dateCreated;

    public function __construct()
    {
        $this->priorityId = new ArrayCollection();
        $this->taskComments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getPriorityId(): ?TaskPriority
    {
        return $this->priorityId;
    }

    public function setPriorityId(?TaskPriority $priorityId): self
    {
        $this->priorityId = $priorityId;

        return $this;
    }

    public function getColumnId(): ?TaskColumn
    {
        return $this->columnId;
    }

    public function setColumnId(?TaskColumn $columnId): self
    {
        $this->columnId = $columnId;

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

    /**
     * @return Collection|TaskComment[]
     */
    public function getTaskComments(): Collection
    {
        return $this->taskComments;
    }

    public function addTaskComment(TaskComment $taskComment): self
    {
        if (!$this->taskComments->contains($taskComment)) {
            $this->taskComments[] = $taskComment;
            $taskComment->setTaskId($this);
        }

        return $this;
    }

    public function removeTaskComment(TaskComment $taskComment): self
    {
        if ($this->taskComments->removeElement($taskComment)) {
            // set the owning side to null (unless already changed)
            if ($taskComment->getTaskId() === $this) {
                $taskComment->setTaskId(null);
            }
        }

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(?string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getOwnerId(): ?User
    {
        return $this->ownerId;
    }

    public function setOwnerId(?User $ownerId): self
    {
        $this->ownerId = $ownerId;

        return $this;
    }

    public function getExecutorId(): ?User
    {
        return $this->executorId;
    }

    public function setExecutorId(?User $executorId): self
    {
        $this->executorId = $executorId;

        return $this;
    }

    public function getDateCreated(): ?\DateTimeImmutable
    {
        return $this->dateCreated;
    }

    public function setDateCreated(\DateTimeImmutable $dateCreated): self
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }
}
