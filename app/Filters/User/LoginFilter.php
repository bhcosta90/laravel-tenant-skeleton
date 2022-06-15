<?php

declare(strict_types=1);

namespace App\Filters\User;

use App\Filters\Abstracts\FilterAbstract;

class LoginFilter extends FilterAbstract
{
    public function handle(): array
    {
        return [
            'label' => 'Login',
            'type' => 'text',
            'name' => 'login',
        ];
    }
}
