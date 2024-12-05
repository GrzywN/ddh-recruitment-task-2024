<?php

namespace App\Services\Forms\Validators;

use App\Services\Forms\Contracts\FormFieldValidatorInterface;

class MinLengthValidator implements FormFieldValidatorInterface
{
    public function __construct(private readonly string $displayName, private readonly int $minLength) {}

    #[\Override]
    public function validate(mixed $value): ?string
    {
        if (! is_string($value)) {
            return null;
        }

        if (strlen($value) < $this->minLength) {
            return "Pole {$this->displayName} musi mieć co najmniej {$this->minLength} znaków.";
        }

        return null;
    }
}
