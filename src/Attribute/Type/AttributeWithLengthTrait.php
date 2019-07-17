<?php

namespace Dvi\Symfony\Validation\Attribute\Type;

use Symfony\Component\Validator\Constraints\Length;

trait AttributeWithLengthTrait
{
    use AttributeBaseTrait;

    /**@var Length*/
    private $length;

    public function min(int $min)
    {
        $this->length = $this->getLength($min);

        $this->length->minMessage = $this->getMessage('min_length');

        return $this;
    }

    public function max(int $max)
    {
        $this->length = $this->getLength(0);
        $this->length->max = $max;
        $this->length->maxMessage = $this->getMessage('max_length');

        return $this;
    }

    private function getLength($min = 0)
    {
        if ($this->length) {
            return $this->length;
        }
        $options = ['min' => $min];

        $this->length = new Length($options);
        $this->validators[] = $this->length;
        return $this->length;
    }
}
