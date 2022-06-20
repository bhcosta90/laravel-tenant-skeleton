<?php

declare(strict_types=1);

namespace Core\Modules\User\UseCases\DTO\List;

class Output
{
    public function __construct(
        public array $items,
        public int $total,
        public int $total_page,
        public int $last_page,
        public int $first_page,
        public int $per_page,
        public int $to,
        public int $from,
        public int $current_page,
    ) {
    }
}
