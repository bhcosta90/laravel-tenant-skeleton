<?php

namespace Core\Shared\ValueObjects\Input;

use Core\Shared\Validations\DomainValidation;

class EmailInputObject
{
    public function __construct(public ?string $value, $acceptNull = false)
    {
        if ($acceptNull) {
            DomainValidation::emailCanNull($value);
        } else {
            DomainValidation::email($value, 3);
        }
    }
}
