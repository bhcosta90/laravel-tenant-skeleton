<?php

namespace App\Exceptions;

use Core\Shared\Interfaces\EventManagerInterface;

class EventManager implements EventManagerInterface
{
    public function dispatch(array $events): void
    {
        foreach ($events as $event) {
            event($event->name(), $event->payload());
        }
    }
}
