<?php

namespace App\Entity\Attribute;

use Dvi\Symfony\Validation\Attribute\Type\Contract\AttributeInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Mapping\ClassMetadata;

trait RunValidationTrait
{
    public static function run(ClassMetadata $metadata)
    {
        /**@var AttributeInterface $attribute*/
        foreach (self::$attributes as $attribute) {
            $validators = $attribute->validators();
            if (!$validators) {
                continue;
            }
            /**@var Constraint $validator*/
            foreach ($validators as $validator) {
                $metadata->addPropertyConstraint($attribute->name(), $validator);
            }
        }
    }
}
