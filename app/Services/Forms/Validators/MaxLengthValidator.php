<?php

namespace App\Services\Forms\Validators;

use App\Services\Forms\Contracts\FormFieldValidatorInterface;

class MaxLengthValidator implements FormFieldValidatorInterface
{
    public function __construct(private readonly string $displayName, private readonly int $maxLength) {}

    #[\Override]
    public function validate(mixed $value): ?string
    {
        if (! is_string($value)) {
            return null;
        }

        if (strlen($value) > $this->maxLength) {
            return "Pole {$this->displayName} nie może być dłuższe niż {$this->maxLength} znaków.";
        }

        return null;
    }
}
