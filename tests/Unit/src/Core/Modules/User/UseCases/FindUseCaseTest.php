<?php

namespace Tests\Unit\src\Core\Modules\User\UseCases;

use Core\Modules\User\Repository\UserRepositoryInterface as Repo;
use Core\Modules\User\UseCases\FindUseCase as UseCase;
use Core\Modules\User\Domain\UserEntity as Entity;
use Core\Modules\User\UseCases\DTO\Find\Input;
use Core\Modules\User\UseCases\DTO\Find\Output;
use Core\Shared\ValueObjects\Input\LoginInputObject;
use Core\Shared\ValueObjects\Input\NameInputObject;
use Core\Shared\ValueObjects\Input\PasswordInputObject;
use Mockery;
use PHPUnit\Framework\TestCase;
use stdClass;

class FindUseCaseTest extends TestCase
{
    public function testHandle()
    {
        $objEntity = $this->mockEntity('bruno costa', 'bruno costa', 'teste123456');

        $uc = new UseCase(
            repo: $this->mockRepo($objEntity),
        );

        $ret = $uc->handle(new Input(
            id: $objEntity->id(),
        ));

        $this->assertInstanceOf(Output::class, $ret);
        $this->assertNotEmpty($ret->id);
    }

    protected function mockRepo($entity)
    {
        /** @var Repo|Mockery\MockInterface */
        $mockRepo =  Mockery::mock(stdClass::class, Repo::class);
        $mockRepo->shouldReceive('find')->times(1)->andReturn($entity);
        return $mockRepo;
    }

    protected function mockEntity($name, $login, $password, $id = null)
    {
        return new Entity(
            name: new NameInputObject($name),
            login: new LoginInputObject($login),
            password: new PasswordInputObject($password),
            id: $id
        );
    }
}
