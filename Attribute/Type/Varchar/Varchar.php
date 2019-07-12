<?php

namespace App\Entity\Attribute\Type;

use App\Entity\Attribute\Type\Contract\AttributeInterface;

class Varchar extends AttributeBase implements AttributeInterface
{
    use AttributeWithLengthTrait;
}
