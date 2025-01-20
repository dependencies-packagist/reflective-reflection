<?php

namespace Reflective\Reflection\Support;

use Iterator;
use ReflectionClass;

class ReflectionParentClassIterator implements Iterator
{
    public function __construct(private ?ReflectionClass $class = null)
    {
        //$this->class = $this->class?->getParentClass();
    }

    public function current(): ?ReflectionClass
    {
        return $this->class ?: null;
    }

    public function key(): ?string
    {
        return $this->class?->getName();
    }

    public function next(): void
    {
        $this->class = $this->class?->getParentClass() instanceof ReflectionClass ? $this->class->getParentClass() : null;
    }

    public function rewind(): void
    {
        // Reset to the original state
    }

    public function valid(): bool
    {
        return $this->class instanceof ReflectionClass;
    }

}
