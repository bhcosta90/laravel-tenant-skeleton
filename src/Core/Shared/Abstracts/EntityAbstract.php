<?php

declare(strict_types=1);

namespace Core\Shared\Abstracts;

use Core\Shared\Interfaces\EntityInterface;
use Core\Shared\ValueObjects\UuidObject;
use DateTime;
use DeepCopy\Exception\PropertyException;

abstract class EntityAbstract implements EntityInterface
{
    public function __construct()
    {
        if (property_exists($this, 'createdAt')) {
            $this->createdAt = $this->createdAt ?: new DateTime();
        }

        if (property_exists($this, 'updatedAt')) {
            $this->updatedAt = $this->updatedAt ?: new DateTime();
        }

        if (property_exists($this, 'id')) {
            $this->id = $this->id ?: UuidObject::random();
        }
    }

    public function __get($property)
    {
        if (property_exists($this, $property)) {
            return $this->{$property};
        }

        $className = get_class($this);
        throw new PropertyException("Property {$property} not found in class {$className}");
    }

    public function id(): string
    {
        return (string) $this->id;
    }

    public function createdAt($format = 'Y-m-d H:i:s'): string
    {
        return $this->createdAt->format($format);
    }

    public function updatedAt($format = 'Y-m-d H:i:s'): string
    {
        return $this->updatedAt->format($format);
    }
}
