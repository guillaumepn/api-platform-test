<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * @Annotation
 */
final class TestConstraintValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint): void
    {
        if ($value === 'TEST') {
            $this->context->buildViolation($constraint->message)->addViolation();
        }
    }
}
