<?php

declare(strict_types=1);

namespace Core\Modules\User\UseCases;

use Core\Modules\User\Domain\UserEntity;
use Core\Modules\User\Events\UserEventInterface;
use Core\Modules\User\Repository\UserRepositoryInterface;
use Core\Shared\ValueObjects\Input\{EmailInputObject, LoginInputObject, NameInputObject, PasswordInputObject};

class CreatedUseCase
{
    public function __construct(
        private UserRepositoryInterface $repo,
        private UserEventInterface $event,
    ) {
        //
    }

    public function handle(DTO\Created\Input $input): DTO\Created\Output
    {
        $login = new LoginInputObject($input->login);

        if (strpos($input->login, "@") !== false) {
            $login = new EmailInputObject($input->login);
        }

        $obj = new UserEntity(
            name: new NameInputObject($input->name),
            login: $login,
            password: $input->password ?: $this->randomPassword(8),
        );

        $entity = $this->repo->insert($obj);
        $this->event->dispatch($entity->events);

        return new DTO\Created\Output(
            id: $entity->id(),
            name: $entity->name->value,
            login: $entity->login->value,
            password: $entity->password->value,
        );
    }

    private function randomPassword($total = 8)
    {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < $total; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }
}
