<?php

namespace App\Entity;

use App\Repository\TaskSwimlaneRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TaskSwimlaneRepository::class)
 */
class TaskSwimlane
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
     * @ORM\OneToMany(targetEntity=Task::class, mappedBy="swimlaneId", orphanRemoval=true)
     */
    private $tasks;

    /**
     * @ORM\OneToMany(targetEntity=TaskColumn::class, mappedBy="swimlaneId")
     */
    private $taskColumns;

    public function __construct()
    {
        $this->tasks = new ArrayCollection();
        $this->taskColumns = new ArrayCollection();
    }

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

    /**
     * @return Collection|Task[]
     */
    public function getTasks(): Collection
    {
        return $this->tasks;
    }

    public function addTask(Task $task): self
    {
        if (!$this->tasks->contains($task)) {
            $this->tasks[] = $task;
            $task->setSwimlaneId($this);
        }

        return $this;
    }

    public function removeTask(Task $task): self
    {
        if ($this->tasks->removeElement($task)) {
            // set the owning side to null (unless already changed)
            if ($task->getSwimlaneId() === $this) {
                $task->setSwimlaneId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|TaskColumn[]
     */
    public function getTaskColumns(): Collection
    {
        return $this->taskColumns;
    }

    public function addTaskColumn(TaskColumn $taskColumn): self
    {
        if (!$this->taskColumns->contains($taskColumn)) {
            $this->taskColumns[] = $taskColumn;
            $taskColumn->setSwimlaneId($this);
        }

        return $this;
    }

    public function removeTaskColumn(TaskColumn $taskColumn): self
    {
        if ($this->taskColumns->removeElement($taskColumn)) {
            // set the owning side to null (unless already changed)
            if ($taskColumn->getSwimlaneId() === $this) {
                $taskColumn->setSwimlaneId(null);
            }
        }

        return $this;
    }
}
