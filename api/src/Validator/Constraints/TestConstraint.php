<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class TestConstraint extends Constraint
{
    public $message = 'wrong!';
}
