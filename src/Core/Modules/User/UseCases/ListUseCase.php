<?php

declare(strict_types=1);

namespace Core\Modules\User\UseCases;

use Core\Modules\User\Repository\UserRepository;

class ListUseCase
{
    public function __construct(
        private UserRepository $repo
    ) {
        //
    }

    public function handle(DTO\List\Input $input): DTO\List\Output
    {
        $result = $this->repo->paginate(
            $input->filter,
            $input->page,
            $input->total
        );

        $data = array_map(fn ($rs) => $this->repo->entity($rs), $result->items());

        return new DTO\List\Output(
            items: $data,
            total: $result->total(),
            last_page: $result->lastPage(),
            first_page: $result->firstPage(),
            per_page: $result->perPage(),
            to: $result->to(),
            from: $result->from(),
            current_page: $result->currentPage(),
            total_page: $result->totalPage(),
        );
    }
}
