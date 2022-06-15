<?php

namespace Tests\Feature\src\Core\Modules\User\UseCases;

use App\Models\User;
use Core\Modules\User\Repository\UserRepository;
use Core\Modules\User\UseCases\ListUseCase;
use Core\Modules\User\UseCases\DTO\List\{Input, Output};
use Tests\TestCase;

class ListUseCaseTest extends TestCase
{
    public function testHandle()
    {
        User::factory(50)->create();
        User::factory()->create(['name' => 'aaaaaaaaaaaaaaaaa']);

        $uc = new ListUseCase(
            repo: app(UserRepository::class)
        );

        $ret = $uc->handle(new Input());
        $this->assertInstanceOf(Output::class, $ret);
        $this->assertEquals(51, $ret->total);
        $this->assertEquals(25, $ret->per_page);
        $this->assertEquals(3, $ret->last_page);
    }

    public function testHandlePage()
    {
        User::factory(35)->create();
        $uc = new ListUseCase(
            repo: app(UserRepository::class)
        );

        $ret = $uc->handle(new Input(
            page: 2
        ));
        $this->assertEquals(2, $ret->current_page);
        $this->assertEquals(10, $ret->total_page);
    }

    public function testHandleLimit(){
        User::factory(35)->create();
        $uc = new ListUseCase(
            repo: app(UserRepository::class)
        );

        $ret = $uc->handle(new Input(
            total: 50
        ));
        $this->assertEquals(1, $ret->current_page);
        $this->assertEquals(35, $ret->total_page);
        $this->assertEquals(50, $ret->per_page);
    }

    public function testHandleFilterId()
    {
        $users = User::factory(50)->create();

        $uc = new ListUseCase(
            repo: app(UserRepository::class)
        );

        $ret = $uc->handle(new Input(
            filter: ['id' => ['teste123456789']]
        ));
        $this->assertEquals(0, $ret->total);
        $this->assertEquals(1, $ret->last_page);

        $ret = $uc->handle(new Input(
            filter: ['id' => [$users[0]->id, $users[2]->id]]
        ));
        $this->assertEquals(2, $ret->total);
        $this->assertEquals(1, $ret->last_page);
    }
    
    public function testHandleFilterName()
    {
        User::factory(50)->create();
        User::factory(10)->create(['name' => 'teste123456789']);

        $uc = new ListUseCase(
            repo: app(UserRepository::class)
        );

        $ret = $uc->handle(new Input(
            filter: ['name' => 'teste1234567891']
        ));
        $this->assertEquals(0, $ret->total);
        $this->assertEquals(1, $ret->last_page);

        $ret = $uc->handle(new Input(
            filter: ['name' => 'teste123456789']
        ));
        $this->assertEquals(10, $ret->total);
        $this->assertEquals(1, $ret->last_page);
    }

    public function testHandleFilterEmail()
    {
        User::factory(50)->create();
        User::factory()->create(['email' => 'teste123456789']);

        $uc = new ListUseCase(
            repo: app(UserRepository::class)
        );

        $ret = $uc->handle(new Input(
            filter: ['email' => 'teste1234567891']
        ));
        $this->assertEquals(0, $ret->total);
        $this->assertEquals(1, $ret->last_page);

        $ret = $uc->handle(new Input(
            filter: ['email' => 'teste123456789']
        ));
        $this->assertEquals(1, $ret->total);
        $this->assertEquals(1, $ret->last_page);
    }
}
