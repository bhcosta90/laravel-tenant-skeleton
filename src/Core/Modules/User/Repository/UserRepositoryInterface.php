<?php

declare(strict_types=1);

namespace Core\Modules\User\Repository;

use Core\Shared\Abstracts\EntityAbstract;
use Core\Shared\Interfaces\RepositoryInterface;

interface UserRepositoryInterface extends RepositoryInterface
{
    public function password(EntityAbstract $entity): EntityAbstract;
}
