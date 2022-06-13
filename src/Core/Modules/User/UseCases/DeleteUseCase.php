<?php

declare(strict_types=1);

namespace Core\Modules\User\UseCases;

use Core\Modules\User\Repository\UserRepository;
use Core\Shared\ValueObjects\DeleteObject;

class DeleteUseCase
{
    public function __construct(private UserRepository $repo)
    {
        //
    }

    public function handle(DTO\Find\Input $input): DeleteObject
    {
        $entity = $this->repo->find($input->id);
        $success = $this->repo->delete($entity);
        return new DeleteObject($success);
    }
}
