<?php

declare(strict_types=1);

namespace Core\Modules\User\UseCases;

use Core\Modules\User\Exceptions\UserLoginException;
use Core\Modules\User\Repository\UserRepositoryInterface;
use Core\Shared\ValueObjects\DeleteObject;

class DeleteUseCase
{
    public function __construct(
        private UserRepositoryInterface $repo
    ) {
        //
    }

    public function handle(DTO\Find\Input $input): DeleteObject
    {
        $entity = $this->repo->find($input->id);

        if ($entity->id() === $input->idLogin) {
            throw new UserLoginException('You cannot delete the user who is currently logged in.');
        }

        $success = $this->repo->delete($entity);
        return new DeleteObject($success);
    }
}
