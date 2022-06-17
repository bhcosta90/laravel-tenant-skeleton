<?php

namespace Tests\Feature\src\Core\Modules\User\UseCases;

use App\Models\User;
use Core\Modules\User\Exceptions\UserLoginException;
use Core\Modules\User\Repository\UserRepositoryInterface;
use Core\Modules\User\UseCases\PasswordUseCase;
use Core\Modules\User\UseCases\DTO\Password\{Input, Output};
use Tests\TestCase;

class PasswordUseCaseTest extends TestCase
{
    public function testHandle()
    {
        $user = User::factory()->create(['name' => 'aaaaaaaaaaaaaaaaa']);
        $uc = new PasswordUseCase(
            repo: app(UserRepositoryInterface::class)
        );
        $ret = $uc->handle(new Input(id: $user->id, password: 'teste123', passwordActive: 'password'));
        $this->assertInstanceOf(Output::class, $ret);
        $this->assertTrue(password_verify('teste123', $ret->password));
    }

    public function testHandleLoginException()
    {
        $this->expectException(UserLoginException::class);
        $this->expectExceptionMessage('Incorrect username or password');
        $user = User::factory()->create(['name' => 'aaaaaaaaaaaaaaaaa']);
        $uc = new PasswordUseCase(
            repo: app(UserRepositoryInterface::class)
        );
        $uc->handle(new Input(id: $user->id, password: 'teste123', passwordActive: 'teste123'));
    }
}
