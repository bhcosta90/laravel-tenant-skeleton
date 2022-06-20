<?php

declare(strict_types=1);

namespace Core\Shared\Interfaces;

use Core\Shared\Abstracts\EventAbstract;

interface EventManagerInterface
{
    /**
     * @param EventAbstract[] $events
     * @return void
     */
    public function dispatch(array $events): void;
}
