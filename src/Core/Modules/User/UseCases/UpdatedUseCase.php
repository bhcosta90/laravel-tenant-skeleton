<?php

declare(strict_types=1);

namespace Core\Modules\User\UseCases;

use Core\Modules\User\Domain\UserEntity;
use Core\Modules\User\Repository\UserRepository;
use Core\Shared\ValueObjects\Input\EmailInputObject;
use Core\Shared\ValueObjects\Input\LoginInputObject;
use Core\Shared\ValueObjects\Input\NameInputObject;

class UpdatedUseCase
{
    public function __construct(private UserRepository $repo)
    {
        //
    }

    public function handle(DTO\Updated\Input $input): DTO\Updated\Output
    {
        $login = new LoginInputObject($input->login);

        if (strpos($input->login, "@") !== false) {
            $login = new EmailInputObject($input->login);
        }

        /** @var UserEntity */
        $entity = $this->repo->find($input->id);

        $entity->update(
            name: new NameInputObject($input->name),
            login: $login
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
