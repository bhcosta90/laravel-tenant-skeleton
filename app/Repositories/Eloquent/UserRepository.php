<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\Presenters\PaginatorPresenter;
use Core\Modules\User\Domain\UserEntity;
use Core\Modules\User\Repository\UserRepository as RepositoryUserRepository;
use Core\Shared\Abstracts\EntityAbstract;
use Core\Shared\Interfaces\PaginationInterface;
use Core\Shared\ValueObjects\Input\LoginInputObject;
use Core\Shared\ValueObjects\Input\NameInputObject;
use Core\Shared\ValueObjects\Input\PasswordInputObject;
use Core\Shared\ValueObjects\UuidObject;
use DateTime;

class UserRepository implements RepositoryUserRepository
{
    public function __construct(private User $model)
    {
        //        
    }

    public function insert(EntityAbstract $entity): EntityAbstract
    {
        $model = $this->model->create([
            'id' => $entity->id(),
            'password' => $entity->password->value,
            'name' => $entity->name->value,
            'email' => $entity->login->value,
        ]);

        return $this->entity($model);
    }

    public function update(EntityAbstract $entity): EntityAbstract
    {
        $obj = $this->model->find($entity->id());
        
        $obj->update([
            'name' => $entity->name->value,
            'email' => $entity->login->value,
        ]);

        return $this->entity($obj);
    }

    public function find(string|int $key): EntityAbstract
    {
        return $this->entity($this->model->find($key));
    }

    public function exist(string|int $key): bool
    {
    }

    public function delete(EntityAbstract $entity): bool
    {
    }

    public function paginate(?array $filter = null, ?int $page = 1, ?int $totalPage = 15): PaginationInterface
    {
        $result = $this->model
            ->where(fn ($q) => ($f = $filter['name'] ?? null) ? $q->where('name', 'like', "%{$f}%") : null)
            ->where(fn ($q) => ($f = $filter['email'] ?? null) ? $q->where('email', $f) : null)
            ->where(fn ($q) => ($f = $filter['id'] ?? null) ? $q->whereIn('id', $f) : null)
            ->orderBy('name');

        return new PaginatorPresenter($result->paginate());
    }

    public function all(?array $filter = null): array|object
    {
    }

    public function pluck(): array
    {
    }

    private function entity(object $input): UserEntity
    {
        return new UserEntity(
            name: new NameInputObject($input->name),
            login: new LoginInputObject($input->email),
            password: new PasswordInputObject($input->password, false),
            id: new UuidObject($input->id),
            createdAt: new DateTime($input->created_at),
        );
    }
}
