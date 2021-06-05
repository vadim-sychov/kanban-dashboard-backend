<?php
declare(strict_types=1);

namespace App\Module\EntityTransformer;

use App\Entity\Task;

class TaskArrayTransformer extends AbstractEntityArrayTransformer
{
    private PriorityArrayTransformer $priorityArrayTransformer;
    private ColumnArrayTransformer $columnArrayTransformer;
    private SwimlaneArrayTransformer $swimlaneArrayTransformer;
    private UserArrayTransformer $userArrayTransformer;

    public function __construct(
        PriorityArrayTransformer $priorityArrayTransformer,
        ColumnArrayTransformer $columnArrayTransformer,
        SwimlaneArrayTransformer $swimlaneArrayTransformer,
        UserArrayTransformer $userArrayTransformer
    )
    {
        $this->priorityArrayTransformer = $priorityArrayTransformer;
        $this->columnArrayTransformer = $columnArrayTransformer;
        $this->swimlaneArrayTransformer = $swimlaneArrayTransformer;
        $this->userArrayTransformer = $userArrayTransformer;
    }

    /**
     * @param Task $task
     * @return array
     */
    public function toArray($task): array
    {
        return [
            'id' => $task->getId(),
            'title' => $task->getTitle(),
            'text' => $task->getText(),
            'date_created' => $task->getDateCreated()->format('Y-m-d H:i:s'),
            'priority' => $this->priorityArrayTransformer->toArray($task->getPriorityId()),
            'column' => $this->columnArrayTransformer->toArray($task->getColumnId()),
            'swimlane' => $this->swimlaneArrayTransformer->toArray($task->getSwimlaneId()),
            'owner' => $this->userArrayTransformer->toArray($task->getOwnerId()),
            'executor' => $this->userArrayTransformer->toArray($task->getExecutorId()),
        ];
    }
}
