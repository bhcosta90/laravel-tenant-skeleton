<?php

namespace Core\Modules\User\UseCases;

use Core\Modules\User\Domain\UserEntity;
use Core\Modules\User\Repository\UserRepository;
use Core\Shared\ValueObjects\Input\NameInputObject;

class UpdatedUseCase
{
    public function __construct(private UserRepository $repo)
    {
        //
    }

    public function handle(DTO\Updated\Input $input): DTO\Updated\Output
    {
        /** @var UserEntity */
        $entity = $this->repo->find($input->id);

        $entity->update(
            name: new NameInputObject($input->name),
            login: $input->login
        );

        $entity = $this->repo->update($entity);

        return new DTO\Updated\Output(
            id: $entity->id(),
            name: $entity->name->value,
            login: $entity->login->value,
            password: $entity->password->value,
        );
    }
}
