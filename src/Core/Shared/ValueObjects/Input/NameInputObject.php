<?php

namespace Core\Shared\ValueObjects\Input;

use Core\Shared\Validations\DomainValidation;

class NameInputObject
{
    public function __construct(public ?string $value, $acceptNull = false)
    {
        if ($acceptNull) {
            DomainValidation::strCanNullAndMinLength($value, 3);
            DomainValidation::strCanNullAndMaxLength($value, 255);
        } else {
            DomainValidation::strMinLength($value, 3);
            DomainValidation::strMaxLength($value, 255);
        }
    }
}
