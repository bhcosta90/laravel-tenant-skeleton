<?php

declare(strict_types=1);

namespace Core\Modules\User\UseCases\DTO\Created;

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
