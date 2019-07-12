<?php

namespace App\Entity;

use Symfony\Component\Validator\Validation;

class Validator
{
    public static function validate($entity)
    {
        return Validation::createValidatorBuilder()
            ->addMethodMapping('run')
            ->getValidator()
            ->validate($entity);
    }
}
