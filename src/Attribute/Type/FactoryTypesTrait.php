<?php

namespace Dvi\Symfony\Validation\Attribute\Type;

use Dvi\Symfony\Validation\Attribute\Type\Varchar\Hidden;

trait FactoryTypesTrait
{
    public function varchar($name, string $label = null)
    {
        $attr = new Varchar($name, $this->translator, $label);
        $this->addAttribute($attr);

        return $attr;
    }

    public function hidden($name)
    {
        $attr = new Hidden($name, $this->translator);
        $this->addAttribute($attr);

        return $attr;
    }
}
