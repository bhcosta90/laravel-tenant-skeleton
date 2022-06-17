<?php

namespace App\Shared;

use Core\Shared\Interfaces\EventManagerInterface;

class EventManager implements EventManagerInterface
{
    public function dispatch(array $data): void
    {
        foreach ($data as $rs) {
            event($rs->name(), $rs->payload());
        }
    }
}
