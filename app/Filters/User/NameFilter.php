<?php

declare(strict_types=1);

namespace App\Filters\User;

use App\Filters\Abstracts\FilterAbstract;

class NameFilter extends FilterAbstract
{
    public function handle(): array
    {
        return [
            'label' => 'Name',
            'type' => 'text',
            'name' => 'name',
            'placeholder' => 'Digite aqui o nome que você quer pesquisar'
        ];
    }
}
