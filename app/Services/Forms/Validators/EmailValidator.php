<?php

namespace App\Services\Forms\Validators;

use App\Services\Forms\Contracts\FormFieldValidatorInterface;

class EmailValidator implements FormFieldValidatorInterface
{
    public function __construct(private readonly string $displayName) {}

    #[\Override]
    public function validate(mixed $value): ?string
    {
        if (! filter_var($value, FILTER_VALIDATE_EMAIL)) {
            return "Pole {$this->displayName} musi być poprawnym adresem email.";
        }

        return null;
    }
}
