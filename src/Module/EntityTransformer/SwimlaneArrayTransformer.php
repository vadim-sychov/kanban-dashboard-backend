<?php
declare(strict_types=1);

namespace App\Module\EntityTransformer;

use App\Entity\TaskSwimlane;

class SwimlaneArrayTransformer extends AbstractEntityArrayTransformer
{
    /**
     * @param TaskSwimlane $taskSwimlane
     * @return array
     */
    public function toArray($taskSwimlane): array
    {
        return [
            'id' => $taskSwimlane->getId(),
            'name' => $taskSwimlane->getName(),
        ];
    }
}
