<?php

declare(strict_types=1);

namespace Core\Modules\User\UseCases;

use Core\Modules\User\Domain\UserEntity;
use Core\Modules\User\Exceptions\UserLoginException;
use Core\Modules\User\Repository\UserRepositoryInterface;

class PasswordUseCase
{
    public function __construct(
        private UserRepositoryInterface $repo
    ) {
        //
    }

    public function handle(DTO\Password\Input $input): DTO\Password\Output
    {
        /** @var UserEntity */
        $entity = $this->repo->find($input->id);

        if (!$entity->login($input->passwordActive)) {
            throw new UserLoginException('Incorrect username or password');
        }

        $entity->password($input->password);
        $entity = $this->repo->password($entity);

        return new DTO\Password\Output(
            id: $entity->id(),
            name: $entity->name->value,
            login: $entity->login->value,
            password: $entity->password->value,
        );
    }
}
