<?php

declare(strict_types=1);

namespace Core\Modules\User\UseCases;

use Core\Modules\User\Domain\UserEntity;
use Core\Modules\User\Exceptions\UserLoginException;
use Core\Modules\User\Repository\UserRepositoryInterface;

class ProfileUseCase
{
    public function __construct(
        private UserRepositoryInterface $repo
    ) {
        //
    }

    public function handle(DTO\Profile\Input $input): DTO\Profile\Output
    {
        /** @var UserEntity */
        $entity = $this->repo->find($input->id);

        if (!$entity->login($input->password)) {
            throw new UserLoginException('Incorrect username or password');
        }

        $entity = $this->repo->update($entity);

        return new DTO\Profile\Output(
            id: $entity->id(),
            name: $entity->name->value,
            login: $entity->login->value,
            password: $entity->password->value,
        );
    }
}
