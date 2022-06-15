<?php

declare(strict_types=1);

namespace App\Filters\User;

use App\Filters\Abstracts\FilterAbstract;

class EmailFilter extends FilterAbstract
{
    public function handle(): array
    {
        return [
            'label' => 'E-mail',
            'type' => 'text',
            'name' => 'email',
            'placeholder' => 'Digite aqui o e-mail que você quer pesquisar'
        ];
    }
}
