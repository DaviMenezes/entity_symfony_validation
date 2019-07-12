<?php

namespace App\Entity;

use App\Entity\Attribute\Type\FactoryTypesTrait;
use App\Entity\Attribute\Type\Varchar;
use App\Entity\Attribute\Type\Varchar\Hidden;
use Dvi\Support\Service\ReflectionHelpers;
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

    public function validate($entity)
    {
        return Validation::createValidatorBuilder()
            ->addMethodMapping('run')
            ->getValidator()
            ->validate($entity);
    }
}
