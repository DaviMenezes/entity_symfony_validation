<?php

namespace App\Entity\Attribute\Type;

use App\Entity\Attribute\Type\Varchar\Hidden;

trait FactoryTypesTrait
{
    public function varchar($name)
    {
        $attr = new Varchar($name, $this->translator);
        self::$attributes[] = $attr;
        return $attr;
    }

    public function hidden($name)
    {
        $attr = new Hidden($name, $this->translator);
        self::$attributes[] = $attr;
        return $attr;
    }
}
