<?php

namespace Core\Modules\User\UseCases\DTO\Updated;

use Core\Shared\ValueObjects\Input\{EmailInputObject, LoginInputObject};

class Input
{
    public function __construct(
        public string $id,
        public string $name,
        public LoginInputObject|EmailInputObject $login
    ) {
        //
    }
}
