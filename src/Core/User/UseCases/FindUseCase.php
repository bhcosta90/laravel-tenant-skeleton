<?php

declare(strict_types=1);

namespace Core\Modules\User\UseCases;

use Core\Modules\User\Repository\UserRepositoryInterface;

class FindUseCase
{
    public function __construct(
        private UserRepositoryInterface $repo)
    {
        //
    }

    public function handle(DTO\Find\Input $input): DTO\Find\Output
    {
        $entity = $this->repo->find($input->id);

        return new DTO\Find\Output(
            id: $entity->id(),
            name: $entity->name->value,
            login: $entity->login->value,
            password: $entity->password->value,
        );
    }
}
