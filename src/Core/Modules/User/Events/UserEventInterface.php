<?php

namespace Core\Modules\User\Events;

interface UserEventInterface
{
    public function dispatch(array $events): void;
}
