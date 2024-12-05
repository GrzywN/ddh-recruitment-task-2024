<?php

namespace App\Services\Forms\Fields;

use App\Services\Forms\Contracts\FormFieldInterface;
use App\Services\Forms\Contracts\FormFieldValidatorInterface;

abstract class AbstractFormField implements FormFieldInterface
{
    protected ?string $value = null;

    public function __construct(
        protected readonly string $name,
        /** @var FormFieldValidatorInterface[] */
        protected readonly array $validators,
        protected readonly bool $required = false,
        protected readonly string $placeholder = '',
        protected readonly string $class = ''
    ) {}

    #[\Override]
    public function getName(): string
    {
        return $this->name;
    }

    #[\Override]
    public function setValue(?string $value): void
    {
        $this->value = htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
    }

    /**
     * @return array<int<0, max>, string>.
     */
    #[\Override]
    public function validate(mixed $value): array
    {
        $errors = [];

        foreach ($this->validators as $validator) {
            $error = $validator->validate($value);

            if ($error !== null) {
                $errors[] = $error;
            }
        }

        return $errors;
    }
}
