<?php

namespace Reflective\Reflection;

use ReflectionException;
use ReflectionMethod;

class ReflectionClass extends \ReflectionClass
{
    /**
     * @inheritDoc
     *
     * @throws ReflectionException if the class does not exist.
     *
     * @link https://php.net/manual/en/reflectionclass.construct.php
     */
    public function __construct(object|string $objectOrClass)
    {
        parent::__construct($objectOrClass);
    }

    /**
     * Gets an array of methods for current class.
     *
     * @param int|null $filter Filter the results to include only methods
     *                         with certain attributes. Defaults to no filtering.
     *
     * @return ReflectionMethod[] An array of {@see ReflectionMethod} objects reflecting each method.
     */
    public function getDeclaredMethods(int $filter = null): array
    {
        return array_filter($this->getMethods($filter), function (ReflectionMethod $method) {
            return $method->getDeclaringClass()->getName() === $this->getName();
        });
    }

    /**
     * Indicates that the search for a suitable parent class should not be by
     * strict comparison, but by the inheritance chain.
     *
     * Used for the argument of flags of the "getParentClasses" method.
     *
     * @since 8.0
     */
    public const IS_INSTANCEOF = 2;

    /**
     * Returns an array of class parents.
     *
     * @param string|null $name
     * @param int         $flags
     *
     * @return ReflectionClass[]
     */
    public function getDeclaredParentClass(?string $name = null, int $flags = 0): array
    {
        try {
            return (new ReflectionParentClass($this->getName()))->getDeclaredParentClass($name, $flags);
        } catch (ReflectionException $e) {
            return [];
        }
    }

}
