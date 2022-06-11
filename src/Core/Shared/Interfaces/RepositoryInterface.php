<?php

namespace Core\Shared\Interfaces;

use Core\Shared\Abstracts\EntityAbstract;

interface RepositoryInterface
{
    public function insert(EntityAbstract $entity): EntityAbstract;

    public function update(EntityAbstract $entity): EntityAbstract;

    public function find(string|int $key): EntityAbstract;

    public function exist(string|int $key): bool;

    public function delete(EntityAbstract $entity): bool;

    public function paginate(?array $filter = null, ?int $page = 1, ?int $totalPage = 15): PaginationInterface;

    public function all(?array $filter = null): array|object;

    public function pluck(): array;
}
