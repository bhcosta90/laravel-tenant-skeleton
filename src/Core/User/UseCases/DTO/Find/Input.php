<?php

declare(strict_types=1);

namespace Core\Modules\User\UseCases\DTO\Find;

class Input
{
    public function __construct(
        public string $id,
        public ?string $idLogin = null,
    ) {
        //
    }
}
