<?php

namespace Reflective\Reflection;

use ReflectionClass;
use ReflectionException;

class ReflectionParentClass extends ReflectionClass
{
    public const IS_INSTANCEOF = 2;

    /**
     * Returns an array of class parents.
     *
     * @param string|null $name
     * @param int $flags
     * @return ReflectionClass[]
     */
    public function getParentsClass(?string $name = null, int $flags = 0): array
    {
        $parents = [];
        try {
            $iterator = new ReflectionParentClassIterator(new ReflectionClass($this->getName()));
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
