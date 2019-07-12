<?php

namespace App\Entity\Attribute\Type;

use Symfony\Component\Translation\Translator;

abstract class AttributeBase
{
    use AttributeBaseTrait;

    /**
     * @var string
     */
    protected $name;

    public function __construct(string $name, Translator $translator)
    {
        $this->name = $name;

        $this->translator = $translator;
    }
}
