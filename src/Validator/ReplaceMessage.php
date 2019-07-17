<?php

namespace Dvi\Symfony\Validator;

class ReplaceMessage
{
    /**
     * @var string
     */
    private $message;
    private $variables = [];

    public function __construct(string $message)
    {
        $this->message = $message;
    }

    public function variable(string $variable, string $value)
    {
        $this->variables[$variable] = $value;
    }

    public function replace()
    {
        foreach ($this->variables as $variable => $value) {
            $this->message = str_replace('{{ '.$variable.' }}', $value, $this->message);
        }
        return $this->message;
    }
}
