<?php

namespace Reflective\Reflection;

use Iterator;

class ReflectionParentClassIterator implements Iterator
{
    private ?\ReflectionClass $current;

    public function __construct(private \ReflectionClass $rootClass)
    {
        $this->rootClass = $this->current = $rootClass;
    }

    public function current(): ?ReflectionClass
    {
        return $this->current ? new ReflectionClass($this->current->getName()) : null;
    }

    public function key(): ?string
    {
        return $this->current?->getName() ?? null;
    }

    public function next(): void
    {
        if ($this->current?->getParentClass() instanceof \ReflectionClass) {
            $this->current = $this->current->getParentClass();
        } else {
            $this->current = null;
        }
    }

    public function rewind(): void
    {
        $this->current = $this->rootClass;
    }

    public function valid(): bool
    {
        return $this->current instanceof \ReflectionClass;
    }

}
