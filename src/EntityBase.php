<?php

namespace App\Entity;

use Dvi\Symfony\Validation\Attribute\Type\FactoryTypesTrait;
use Dvi\Symfony\Validation\Attribute\Type\Varchar;
use Dvi\Symfony\Validation\Attribute\Type\Varchar\Hidden;
use Dvi\Support\Service\ReflectionHelpers;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Translation\Loader\PhpFileLoader;
use Symfony\Component\Translation\Translator;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Validation;

abstract class EntityBase
{
    public $id;
    /**
     * @var array
     */
    protected static $attributes;
    /**
     * @var Translator
     */
    private $translator;

    use ReflectionHelpers;
    use FactoryTypesTrait;

    public function __construct()
    {
        $this->translator = new Translator('en');
        $this->translator->addLoader('php', new PhpFileLoader());
        $this->translator->addResource('php', 'translations/validators.en.php', 'en');

        $this->hidden('id');
        $this->attributes();
    }

    abstract protected function attributes();

    abstract public static function run(ClassMetadata $metadata);

    public function validate()
    {
        $violations = Validation::createValidatorBuilder()
            ->addMethodMapping('run')
            ->getValidator()
            ->validate($this);

        $session = new Session();
        http()->obj()->setSession($session);

        $array = [];
        foreach ($violations as $key => $violation) {
            $entity_name = get_class($violation->getRoot());
            $entity_name .= '.' . $violation->getPropertyPath();
            $array[$entity_name] = $violation;

            $session->getFlashBag()->add('validation_violation', [
                'attribute' => $entity_name,
                'violation' => $violation
            ]);
        }

        if (count($violations)) {
            $session->getFlashBag()->add('form_data', $this);
        }

        return $array;
    }

    protected function addAttribute($attribute)
    {
        self::$attributes[] = $attribute;
    }

    public function loadWithPostData()
    {
        foreach (self::$attributes as $attribute) {
            $name = $attribute->name();
            $this->$name = http()->body($name);
        }
    }
}
