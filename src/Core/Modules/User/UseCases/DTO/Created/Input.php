<?php

namespace Core\Modules\User\UseCases\DTO\Created;

use Core\Shared\ValueObjects\Input\{EmailInputObject, LoginInputObject};

class Input
{
    public function __construct(
        public string $name,
        public string $login,
        public string $password,
    ) {
        //
    }
}
