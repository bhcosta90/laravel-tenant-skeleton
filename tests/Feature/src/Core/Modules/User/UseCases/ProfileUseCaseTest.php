<?php

namespace Tests\Feature\src\Core\Modules\User\UseCases;

use App\Models\User;
use Core\Modules\User\Exceptions\UserLoginException;
use Core\Modules\User\Repository\UserRepositoryInterface;
use Core\Modules\User\UseCases\DTO\Profile\{Input, Output};
use Core\Modules\User\UseCases\ProfileUseCase;
use Tests\TestCase;

class ProfileUseCaseTest extends TestCase
{
    public function testHandle()
    {
        $user = User::factory()->create(['name' => 'aaaaaaaaaaaaaaaaa']);
        $uc = new ProfileUseCase(
            repo: app(UserRepositoryInterface::class)
        );
        $ret = $uc->handle(new Input(id: $user->id, login: 'teste123', name: 'teste', password: 'password'));
        $this->assertInstanceOf(Output::class, $ret);
    }

    public function testHandleLoginException()
    {
        $this->expectException(UserLoginException::class);
        $this->expectExceptionMessage('Incorrect username or password');
        $user = User::factory()->create(['name' => 'aaaaaaaaaaaaaaaaa']);
        $uc = new ProfileUseCase(
            repo: app(UserRepositoryInterface::class)
        );
        $uc->handle(new Input(id: $user->id, login: 'teste123', name: 'teste', password: 'teste123'));
    }
}
