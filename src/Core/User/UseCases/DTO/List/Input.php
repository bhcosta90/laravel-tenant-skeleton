<?php

declare(strict_types=1);

namespace Core\Modules\User\UseCases\DTO\List;

class Input
{
    public function __construct(
        public ?array $filter = null,
        public ?int $total = 25,
        public ?int $page = 1,
    ) {
        //
    }
}
