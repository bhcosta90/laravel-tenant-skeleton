<?php

declare(strict_types=1);

namespace Core\Modules\User\Events;

use Core\Modules\User\Domain\UserEntity;
use Core\Shared\Abstracts\EventAbstract;

class CreateUserEvent extends EventAbstract
{
    public function __construct(
        private UserEntity $user,
        private string $password,
    ) {
        //
    }

    public function name(): string
    {
        return 'user.created.' . $this->user->id();
    }

    public function payload(): array
    {
        return [
            'id' => $this->user->id(),
            'email' => $this->user->login->value,
            'password' => $this->password,
        ];
    }
}
