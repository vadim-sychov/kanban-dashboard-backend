<?php
declare(strict_types=1);

namespace App\Module\EntityTransformer;

use App\Entity\TaskComment;

class CommentArrayTransformer extends AbstractEntityArrayTransformer
{
    private UserArrayTransformer $userArrayTransformer;

    public function __construct(UserArrayTransformer $userArrayTransformer)
    {
        $this->userArrayTransformer = $userArrayTransformer;
    }

    /**
     * @param TaskComment $taskComment
     * @return array
     */
    public function toArray($taskComment): array
    {
        return [
            'id' => $taskComment->getId(),
            'text' => $taskComment->getText(),
            'date_created' => $taskComment->getDateCreated()->format('Y-m-d H:i:s'),
            'task_id' => $taskComment->getTaskId()->getId(),
            'user_id' => $this->userArrayTransformer->toArray($taskComment->getUserId()),
        ];
    }
}
