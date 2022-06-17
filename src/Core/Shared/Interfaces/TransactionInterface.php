<?php

declare(strict_types=1);

namespace Core\Shared\Interfaces;

interface TransactionInterface
{
    public function commit(): void;

    public function rollback(): void;
}
