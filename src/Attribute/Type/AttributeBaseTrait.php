<?php

namespace Dvi\Symfony\Validation\Attribute\Type;

use Dvi\Symfony\Validator\ReplaceMessage;
use Symfony\Component\Translation\Translator;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * @property array $attributes
 */
trait AttributeBaseTrait
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $label;

    /**@var Translator*/
    public $translator;

    protected $validators = [];

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
        $notBlank = new NotBlank([
            'message' => $this->getMessage('not_blank')
        ]);

        $this->validators['not_blank'] = $notBlank;
        return $this;
    }

    public function validators()
    {
        return $this->validators;
    }

    protected function getMessage(string $str)
    {
        $message = $this->translator->trans($str);

        $replacer = new ReplaceMessage($message);
        $replacer->variable('attribute', $this->getLabel());
        $message = $replacer->replace();

        return $message;
    }
}
