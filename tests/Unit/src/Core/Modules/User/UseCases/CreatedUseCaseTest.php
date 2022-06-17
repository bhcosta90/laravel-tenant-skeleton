<?php

namespace Tests\Unit\src\Core\Modules\User\UseCases;

use Core\Modules\User\Repository\UserRepositoryInterface as Repo;
use Core\Modules\User\UseCases\CreatedUseCase as UseCase;
use Core\Modules\User\Domain\UserEntity as Entity;
use Core\Modules\User\Events\UserEventInterface;
use Core\Modules\User\UseCases\DTO\Created\Input;
use Core\Modules\User\UseCases\DTO\Created\Output;
use Core\Shared\ValueObjects\Input\LoginInputObject;
use Core\Shared\ValueObjects\Input\NameInputObject;
use Core\Shared\ValueObjects\Input\PasswordInputObject;
use Mockery;
use PHPUnit\Framework\TestCase;
use stdClass;

class CreatedUseCaseTest extends TestCase
{
    public function testHandle()
    {
        $uc = new UseCase(
            repo: $this->mockRepo(),
            event: $this->mockEvent(),
        );

        $ret = $uc->handle(new Input(
            name: 'bruno costa',
            login: 'teste@teste.com',
            password: 'bruno costa',
        ));

        $this->assertInstanceOf(Output::class, $ret);
        $this->assertNotEmpty($ret->id);
    }

    protected function mockRepo()
    {
        /** @var Repo|Mockery\MockInterface */
        $mockRepo =  Mockery::mock(stdClass::class, Repo::class);

        $mockRepo->shouldReceive('insert')->times(1)->andReturn(new Entity(
            name: new NameInputObject('bruno costa'),
            login: new LoginInputObject('bruno costa'),
            password: new PasswordInputObject('bruno5124828')
        ));

        return $mockRepo;
    }

    protected function mockEvent()
    {
        /** @var UserEventInterface|Mockery\MockInterface */
        $mockRepo =  Mockery::mock(stdClass::class, UserEventInterface::class);
        $mockRepo->shouldReceive('dispatch')->times(1);

        return $mockRepo;
    }
}
