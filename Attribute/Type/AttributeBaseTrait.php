<?php

namespace App\Entity\Attribute\Type;

use Symfony\Component\Translation\Translator;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * @property array $attributes
 */
trait AttributeBaseTrait
{
    /**
     * @var bool
     */
    private $required;

    /**@var Translator*/
    public $translator;

    private $validators = [];

    public function name(string $name = null)
    {
        if (!$name) {
            return $this->name;
        }
        $this->name = $name;
        return $this;
    }

    public function required()
    {
        $this->validators[] = new NotBlank([
            'message' => $this->translator->trans('not_blank'),
        ]);
        return $this;
    }

    public function validators()
    {
        return $this->validators;
    }
}
