<?php

namespace Tests\Unit\src\Core\Modules\User\UseCases;

use Core\Modules\User\Repository\UserRepository as Repo;
use Core\Modules\User\UseCases\UpdatedUseCase as UseCase;
use Core\Modules\User\Domain\UserEntity as Entity;
use Core\Modules\User\UseCases\DTO\Updated\Input;
use Core\Modules\User\UseCases\DTO\Updated\Output;
use Core\Shared\ValueObjects\Input\LoginInputObject;
use Core\Shared\ValueObjects\Input\NameInputObject;
use Core\Shared\ValueObjects\Input\PasswordInputObject;
use Mockery;
use PHPUnit\Framework\TestCase;
use stdClass;

class UpdatedUseCaseTest extends TestCase
{
    public function test_handle()
    {
        $objEntity = $this->mockEntity('bruno costa', 'bruno costa', 'teste123456');
        $objEntityUpdated = $this->mockEntity('bruno costa 123', 'bruno costa 123', 'teste123456789', $objEntity->id);

        $uc = new UseCase(
            repo: $this->mockRepo($objEntity, $objEntityUpdated),
        );

        $ret = $uc->handle(new Input(
            id: $objEntity->id(),
            name: 'bruno costa',
            login: new LoginInputObject('teste')
        ));

        $this->assertInstanceOf(Output::class, $ret);
        $this->assertNotEmpty($ret->id);
        $this->assertNotEquals('bruno costa', $ret->name);
        $this->assertEquals('bruno costa 123', $ret->name);
        $this->assertEquals($objEntityUpdated->id(), $objEntity->id());
        $this->assertEquals($objEntityUpdated->id(), $ret->id);
    }

    protected function mockRepo($entity, $entityUpdated = null)
    {
        /** @var Repo|Mockery\MockInterface */
        $mockRepo =  Mockery::mock(stdClass::class, Repo::class);
        $mockRepo->shouldReceive('find')->times(limit: 1)->andReturn($entity);
        $mockRepo->shouldReceive('update')->times(limit: 1)->andReturn($entityUpdated ?: $entity);
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
