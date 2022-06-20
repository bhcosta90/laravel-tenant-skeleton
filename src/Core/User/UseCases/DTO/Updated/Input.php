<?php

declare(strict_types=1);

namespace Core\Modules\User\UseCases\DTO\Updated;

class Input
{
    public function __construct(
        public string $id,
        public string $name,
        public string $login
    ) {
        //
    }
}
