<?php

namespace App\Services\Forms\Contracts;

interface FormFieldInterface
{
    public function getName(): string;

    public function setValue(string $value): void;

    public function render(): string;

    /** @return array<int<0, max>, string> */
    public function validate(mixed $value): array;
}
