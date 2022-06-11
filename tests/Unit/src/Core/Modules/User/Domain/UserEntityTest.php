<?php

namespace Tests\Unit\src\Core\Modules\User\Domain;

use Core\Modules\User\Domain\UserEntity;
use Core\Shared\ValueObjects\Input\{EmailInputObject, NameInputObject, PasswordInputObject};
use PHPUnit\Framework\TestCase;

class UserEntityTest extends TestCase
{
    public function test_entity()
    {
        $obj = new UserEntity(
            name: new NameInputObject('bruno costa'),
            login: new EmailInputObject('teste@teste.com.br'),
            password: new PasswordInputObject('teste123456'),
        );

        $this->assertNotNull($obj->id());
        $this->assertNotNull($obj->createdAt());
    }

    public function test_not_login()
    {
        $obj = new UserEntity(
            name: new NameInputObject('bruno costa'),
            login: new EmailInputObject('teste@teste.com.br'),
            password: new PasswordInputObject('teste123456'),
        );

        $this->assertFalse($obj->login('teste'));
    }

    public function test_login()
    {
        $obj = new UserEntity(
            name: new NameInputObject('bruno costa'),
            login: new EmailInputObject('teste@teste.com.br'),
            password: new PasswordInputObject('teste123456'),
        );

        $this->assertTrue($obj->login('teste123456'));
    }
}
