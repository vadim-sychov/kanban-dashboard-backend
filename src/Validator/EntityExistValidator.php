<?php
declare(strict_types=1);

namespace App\Validator;

use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use UnexpectedValueException;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class EntityExistValidator extends ConstraintValidator
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function validate($id, Constraint $constraint)
    {
        if (!$constraint instanceof EntityExist) {
            throw new UnexpectedTypeException($constraint, EntityExist::class);
        }

        // Custom constraints should ignore null and empty values to allow
        // other constraints (NotBlank, NotNull, etc.) take care of that
        if (null === $id || '' === $id) {
            return;
        }

        if (!is_string($id)) {
            throw new UnexpectedValueException($id, 'string|int');
        }

        $criteria = $constraint->additionalCheckCriteria;
        $criteria['id'] = $id;

        $entity = $this->entityManager->getRepository($constraint->entityClass)->findOneBy($criteria);

        if (is_null($entity)) {
            $this->context->buildViolation($constraint->message)->setParameter('{{ id }}', $id)->addViolation();
        }
    }
}
