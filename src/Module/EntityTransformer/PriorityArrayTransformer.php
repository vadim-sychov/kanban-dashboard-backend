<?php
declare(strict_types=1);

namespace App\Module\EntityTransformer;

use App\Entity\TaskPriority;

class PriorityArrayTransformer extends AbstractEntityArrayTransformer
{
    /**
     * @param TaskPriority $taskPriority
     * @return array
     */
    public function toArray($taskPriority): array
    {
        return [
            'id' => $taskPriority->getId(),
            'name' => $taskPriority->getName(),
            'color' => $taskPriority->getColor(),
        ];
    }
}
