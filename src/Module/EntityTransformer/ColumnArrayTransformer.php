<?php
declare(strict_types=1);

namespace App\Module\EntityTransformer;

use App\Entity\TaskColumn;

class ColumnArrayTransformer extends AbstractEntityArrayTransformer
{
    /**
     * @param TaskColumn $taskColumn
     * @return array
     */
    public function toArray($taskColumn): array
    {
        return [
            'id' => $taskColumn->getId(),
            'name' => $taskColumn->getName(),
            'position' => $taskColumn->getPosition(),
            'swimlane_id' => $taskColumn->getSwimlaneId()->getId(),
        ];
    }
}
