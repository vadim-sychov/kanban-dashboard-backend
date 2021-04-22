<?php
declare(strict_types=1);

namespace App\Module\EntityTransformer;

use App\Entity\User;

class UserArrayTransformer extends AbstractEntityArrayTransformer
{
    /**
     * @param User $user
     * @return array
     */
    public function toArray($user): array
    {
        return [
            'id' => $user->getId(),
            'email' => $user->getEmail(),
            'role' => $user->getCurrentRole(),
        ];
    }
}
