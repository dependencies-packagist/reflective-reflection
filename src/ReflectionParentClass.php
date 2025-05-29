<?php

namespace Reflective\Reflection;

class ReflectionParentClass extends ReflectionClass
{
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
        $parents  = [];
        $iterator = new ReflectionParentClassIterator($this);
        while ($iterator->valid()) {
            $matches = is_null($name)
                || ($flags === 0 && $iterator->current()->getName() === $name)
                || ($flags === self::IS_INSTANCEOF && is_a($iterator->current()->getName(), $name, true));
            if ($matches) {
                $parents[$iterator->key()] = $iterator->current();
            }
            $iterator->next();
        }
        return $parents;
    }

}
