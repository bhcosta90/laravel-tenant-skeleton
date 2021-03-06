<?php

namespace App\Http\Controllers\Web\Presenters;

use Illuminate\Pagination\LengthAwarePaginator;

class PaginationPresenter
{
    public function render($input)
    {
        return new LengthAwarePaginator(
            $input->items,
            $input->total,
            $input->per_page,
            $input->current_page,
            [
                'path' => \Illuminate\Pagination\Paginator::resolveCurrentPath()
            ]
        );
    }
}
