<?php

namespace App\Events;

use Core\Shared\Abstracts\EventAbstract;
use Core\Shared\Interfaces\EventManagerInterface;

class EventManager implements EventManagerInterface
{
    /**
     * @param EventAbstract[] $events
     * @return void
     */
    public function dispatch(array $events): void
    {
        foreach ($events as $event) {
            event($event->name(), $event->payload());
        }
    }
}
