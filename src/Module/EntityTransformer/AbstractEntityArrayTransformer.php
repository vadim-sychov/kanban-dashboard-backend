<?php
declare(strict_types=1);

namespace App\Module\EntityTransformer;

abstract class AbstractEntityArrayTransformer
{
    abstract public function toArray($entity): array;

    public function toArrayAll($list): array
    {
        $result = [];
        foreach ($list as $entity) {
            $result[] = $this->toArray($entity);
        }

        return $result;
    }
}
