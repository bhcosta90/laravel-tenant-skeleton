<?php

namespace Core\Shared\ValueObjects\Input;

use Core\Shared\Validations\DomainValidation;

class PasswordInputObject
{
    public function __construct(public ?string $value, $convert = true, $acceptNull = false)
    {
        if ($convert) {
            if ($acceptNull) {
                DomainValidation::strCanNullAndMinLength($value, 6);
                DomainValidation::strCanNullAndMaxLength($value, 18);
            } else {
                DomainValidation::strMinLength($value, 6);
                DomainValidation::strMaxLength($value, 18);
            }
            if (!empty($this->value)) {
                $this->value = password_hash($this->value, PASSWORD_DEFAULT);
            }
        }
    }
}
