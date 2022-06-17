<?php

namespace App\Events;

use Core\Modules\User\Events\UserEventInterface;
use Illuminate\Support\Facades\Log;

class UserEvent implements UserEventInterface
{
    public function dispatch(array $events): void
    {
        Log::info(json_encode($events));
    }    
}
