<?php

namespace Core\Modules\User\UseCases;

use Core\Modules\User\Domain\UserEntity;
use Core\Modules\User\Repository\UserRepository;
use Core\Shared\ValueObjects\Input\NameInputObject;
use Core\Shared\ValueObjects\Input\PasswordInputObject;

class CreatedUseCase
{
    public function __construct(private UserRepository $repo)
    {
        //
    }

    public function handle(DTO\Created\Input $input): DTO\Created\Output
    {
        $obj = new UserEntity(
            name: new NameInputObject($input->name),
            login: $input->login,
            password: new PasswordInputObject($input->password),
        );

        $entity = $this->repo->insert($obj);

        return new DTO\Created\Output(
            id: $entity->id(),
            name: $entity->name->value,
            login: $entity->login->value,
            password: $entity->password->value,
        );
    }
}
