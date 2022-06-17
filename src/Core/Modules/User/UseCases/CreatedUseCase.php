<?php

declare(strict_types=1);

namespace Core\Modules\User\UseCases;

use Core\Modules\User\Domain\UserEntity;
use Core\Modules\User\Repository\UserRepositoryInterface;
use Core\Shared\Interfaces\EventManagerInterface;
use Core\Shared\Interfaces\TransactionInterface;
use Core\Shared\ValueObjects\Input\{EmailInputObject, LoginInputObject, NameInputObject};
use Throwable;

class CreatedUseCase
{
    public function __construct(
        private UserRepositoryInterface $repo,
        private EventManagerInterface $event,
        private TransactionInterface $transaction,
    ) {
        //
    }

    public function handle(DTO\Created\Input $input): DTO\Created\Output
    {
        try {
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
            $this->event->dispatch($obj->events);
            $this->transaction->commit();

            return new DTO\Created\Output(
                id: $entity->id(),
                name: $entity->name->value,
                login: $entity->login->value,
                password: $entity->password->value,
            );
        } catch (Throwable $e) {
            $this->transaction->rollback();
            throw $e;
        }
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
