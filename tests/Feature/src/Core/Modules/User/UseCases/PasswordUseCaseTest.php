<?php

namespace Tests\Feature\src\Core\Modules\User\UseCases;

use App\Models\User;
use Core\Modules\User\Repository\UserRepositoryInterface;
use Core\Modules\User\UseCases\PasswordUseCase;
use Core\Modules\User\UseCases\DTO\Password\{Input, Output};
use Tests\TestCase;

class PasswordUseCaseTest extends TestCase
{
    public function testHandle()
    {
        User::factory(50)->create();
        $user = User::factory()->create(['name' => 'aaaaaaaaaaaaaaaaa']);

        $uc = new PasswordUseCase(
            repo: app(UserRepositoryInterface::class)
        );

        $ret = $uc->handle(new Input(id: $user->id, password: 'teste123'));
        $this->assertInstanceOf(Output::class, $ret);
        $this->assertTrue(password_verify('teste123', $ret->password));
    }
}
