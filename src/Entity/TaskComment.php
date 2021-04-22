<?php

namespace App\Entity;

use App\Repository\TaskCommentRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TaskCommentRepository::class)
 */
class TaskComment
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumn(nullable=false)
     * @ORM\Column(name="user_id")
     */
    private $userId;

    /**
     * @ORM\ManyToOne(targetEntity=Task::class, inversedBy="taskComments")
     * @ORM\JoinColumn(nullable=false)
     * @ORM\Column(name="task_id")
     */
    private $taskId;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $text;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $dateCreated;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?User
    {
        return $this->userId;
    }

    public function setUserId(?User $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    public function getTaskId(): ?Task
    {
        return $this->taskId;
    }

    public function setTaskId(?Task $taskId): self
    {
        $this->taskId = $taskId;

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
