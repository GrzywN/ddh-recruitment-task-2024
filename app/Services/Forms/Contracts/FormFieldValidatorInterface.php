<?php

namespace App\Services\Forms\Contracts;

interface FormFieldValidatorInterface
{
    public function validate(mixed $value): ?string;
}
