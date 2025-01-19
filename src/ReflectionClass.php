<?php

namespace Reflective\Reflection;

use ReflectionException;
use ReflectionMethod;

class ReflectionClass extends \ReflectionClass
{
    public function __construct(object|string $objectOrClass)
    {
        parent::__construct($objectOrClass);
    }

    /**
     * Gets an array of methods for current class.
     *
     * @param $filter
     *
     * @return ReflectionMethod[]
     */
    public function getDeclaredMethods($filter = null): array
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
    public function getParentClasses(?string $name = null, int $flags = 0): array
    {
        $parents = [];
        try {
            $iterator = new ReflectionParentClassIterator(new \ReflectionClass($this->getName()));
            while ($iterator->valid()) {
                $matches = is_null($name)
                    || ($flags === 0 && $iterator->current()->getName() === $name)
                    || ($flags === self::IS_INSTANCEOF && (is_subclass_of($iterator->current()->getName(), $name) || $iterator->current()->getName() === $name));
                if ($matches) {
                    $parents[$iterator->key()] = $iterator->current();
                }
                $iterator->next();
            }
        } catch (ReflectionException $e) {
            //
        }
        return $parents;
    }

}
