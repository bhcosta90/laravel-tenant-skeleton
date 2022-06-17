<?php

declare(strict_types=1);

namespace Core\Shared\Abstracts;

abstract class EventAbstract
{
    public abstract function name(): string;

    public abstract function payload(): array;
}
