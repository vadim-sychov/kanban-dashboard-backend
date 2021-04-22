<?php
declare(strict_types=1);

namespace App\Validator;

use Symfony\Component\Validator\Constraint;


class EntityExist extends Constraint
{
    public string $message = 'Entity with id {{ id }} does not exist';
    public string $entityClass = '';
    public array $additionalCheckCriteria = [];
}
