<?php

declare(strict_types=1);

namespace Core\Modules\User\Domain;

use Core\Shared\Abstracts\EntityAbstract;
use Core\Shared\ValueObjects\Input\{EmailInputObject, NameInputObject, PasswordInputObject, LoginInputObject};
use Core\Shared\ValueObjects\UuidObject;
use DateTime;

class UserEntity extends EntityAbstract
{
    public function __construct(
        protected NameInputObject $name,
        protected EmailInputObject|LoginInputObject $login,
        protected PasswordInputObject $password,
        protected ?UuidObject $id = null,
        protected ?DateTime $createdAt = null,
    ) {
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
}
