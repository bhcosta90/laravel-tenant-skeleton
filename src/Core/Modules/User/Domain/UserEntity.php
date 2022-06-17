<?php

declare(strict_types=1);

namespace Core\Modules\User\Domain;

use Core\Modules\User\Events\CreateUserEvent;
use Core\Shared\Abstracts\EntityAbstract;
use Core\Shared\ValueObjects\Input\{EmailInputObject, NameInputObject, PasswordInputObject, LoginInputObject};
use Core\Shared\ValueObjects\UuidObject;
use DateTime;

class UserEntity extends EntityAbstract
{
    protected array $events = [];

    public function __construct(
        protected NameInputObject $name,
        protected EmailInputObject|LoginInputObject $login,
        protected PasswordInputObject|string $password,
        protected ?UuidObject $id = null,
        protected ?DateTime $createdAt = null,
    ) {
        if ($this->id() == null) {

            $this->events[] = new CreateUserEvent(
                $this, 
                $password instanceof PasswordInputObject ? $this->password->value : $this->password
            );

            if (!$password instanceof PasswordInputObject) {
                $this->password = new PasswordInputObject($this->password);
            }
        }

        parent::__construct();
    }

    public function login(string $password): bool
    {
        return password_verify($password, $this->password->value);
    }

    public function update(
        NameInputObject $name,
        EmailInputObject|LoginInputObject $login,
    ) {
        $this->name = $name;
        $this->login = $login;
    }

    public function password(string $password)
    {
        $this->password = new PasswordInputObject($password);
    }
}
