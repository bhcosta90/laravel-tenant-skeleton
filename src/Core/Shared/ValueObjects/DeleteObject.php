<?php

namespace Core\Shared\ValueObjects;

class DeleteObject
{
    public function __construct(
        public bool $success
    ) {
        //
    }
}
