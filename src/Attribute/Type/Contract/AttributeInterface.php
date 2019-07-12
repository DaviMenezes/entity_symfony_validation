<?php

namespace App\Entity\Attribute\Type\Contract;

interface AttributeInterface
{
    public function name(string $name = null);
    public function required();
    public function validators();
}
