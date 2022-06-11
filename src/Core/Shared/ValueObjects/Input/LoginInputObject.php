<?php

namespace Core\Shared\ValueObjects\Input;

use Core\Shared\Validations\DomainValidation;

class LoginInputObject
{
    public function __construct(public ?string $value, $acceptNull = false)
    {
        if ($acceptNull) {
            DomainValidation::strCanNullAndMinLength($value, 3);
            DomainValidation::strCanNullAndMaxLength($value, 100);
        } else {
            DomainValidation::strMinLength($value, 3);
            DomainValidation::strMaxLength($value, 100);
        }
    }
}
