<?php

namespace Core\Modules\User\UseCases\DTO\Created;

class Output
{
    public function __construct(
        public string $id,
        public string $name,
        public string $login,
        public string $password,
    ) {
        //
    }
}
