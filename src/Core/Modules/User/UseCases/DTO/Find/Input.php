<?php

namespace Core\Modules\User\UseCases\DTO\Find;

class Input
{
    public function __construct(
        public string $id,
    ) {
        //
    }
}
