<?php

namespace Dvi\Symfony\Validation\Attribute\Type;

use Dvi\Symfony\Validation\Attribute\Type\Contract\AttributeInterface;
use Symfony\Component\Translation\Translator;

abstract class AttributeBase implements AttributeInterface
{
    use AttributeBaseTrait;

    public function __construct(string $name, Translator $translator, string $label = null)
    {
        $this->name = $name;

        $this->translator = $translator;

        $this->label = $label;
    }

    protected function getLabel()
    {
        return $this->label = $this->label ?? ucfirst($this->name);
    }
}
