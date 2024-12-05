<?php

namespace App\Services\Forms\Validators;

use App\Services\Forms\Contracts\FormFieldValidatorInterface;

class RequiredValidator implements FormFieldValidatorInterface
{
    public function __construct(private readonly string $displayName) {}

    #[\Override]
    public function validate(mixed $value): ?string
    {
        if ($value === 0) {
            return null;
        }

        if ($value === false) {
            return null;
        }

        if (empty($value)) {
            return "Pole {$this->displayName} jest wymagane.";
        }

        return null;
    }
}
