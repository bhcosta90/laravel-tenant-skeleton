<?php

namespace Tests\Unit\src\Core\Modules\User\UseCases;

use PHPUnit\Framework\TestCase;
use Core\Modules\User\UseCases\ListUseCase as UseCase;
use Core\Modules\User\Repository\UserRepository as Repo;
use Core\Modules\User\UseCases\DTO\List\{Input, Output};
use Core\Shared\Interfaces\PaginationInterface;
use Mockery;

class ListUseCaseTest extends TestCase
{
    public function test_handle()
    {
        $uc = new UseCase(
            repo: $this->mockRepo()
        );

        $ret = $uc->handle(new Input());
        $this->assertInstanceOf(Output::class, $ret);
    }

    protected function mockRepo()
    {
        /** @var Repo|Mockery\MockInterface */
        $mockRepo =  Mockery::mock(stdClass::class, Repo::class);
        $mockRepo->shouldReceive('paginate')->times(1)->andReturn($this->mockPagination());
        return $mockRepo;
    }

    protected function mockPagination($items = [])
    {
        /** @var PaginationInterface|Mockery\MockInterface */
        $mock = Mockery::mock(stdClass::class, PaginationInterface::class);
        $mock->shouldReceive('items')->andReturn($items);
        $mock->shouldReceive('total')->andReturn(0);
        $mock->shouldReceive('lastPage')->andReturn(0);
        $mock->shouldReceive('firstPage')->andReturn(0);
        $mock->shouldReceive('currentPage')->andReturn(0);
        $mock->shouldReceive('perPage')->andReturn(0);
        $mock->shouldReceive('to')->andReturn(0);
        $mock->shouldReceive('from')->andReturn(0);
        $mock->shouldReceive('totalPage')->andReturn(0);

        return $mock;
    }
}
