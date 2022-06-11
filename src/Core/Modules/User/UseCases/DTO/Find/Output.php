<?php

namespace Core\Modules\User\UseCases\DTO\Find;

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
