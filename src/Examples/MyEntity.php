<?php

namespace App\Entity;

use App\Entity\Attribute\RunValidationTrait;

class MyEntity extends EntityBase
{
    public $name;

    use RunValidationTrait;

    protected function attributes()
    {
        $this->varchar('name')->min(5)->max(10)->required();
    }
}
