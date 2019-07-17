<?php

namespace Dvi\Symfony\Validation\Attribute\Type\Contract;

interface AttributeInterface
{
    public function name(string $name = null);
    public function required();
    public function validators();
}
