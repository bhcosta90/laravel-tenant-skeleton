<?php

declare(strict_types=1);

namespace Core\Shared\Interfaces;

interface EventManagerInterface
{
    public function dispatch(array $data): void;
}
