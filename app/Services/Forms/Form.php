<?php

namespace App\Services\Forms;

use App\Services\Forms\Contracts\FormFieldInterface;

class Form
{
    /** @var FormFieldInterface[] */
    private array $fields = [];

    /** @var array<string, array<int<0, max>, string>> */
    private array $errors = [];

    public function __construct(private readonly string $action) {}

    public function addField(FormFieldInterface $field): self
    {
        $this->fields[] = $field;

        return $this;
    }

    public function getField(string $name): ?FormFieldInterface
    {
        foreach ($this->fields as $field) {
            if ($field->getName() === $name) {
                return $field;
            }
        }

        return null;
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public function validate(array $data): bool
    {
        $this->errors = [];

        foreach ($this->fields as $field) {
            if ($field instanceof FormFieldInterface) {
                $value = $data[$field->getName()] ?? null;

                if (! is_string($value)) {
                    continue;
                }

                $field->setValue($value);
                $fieldErrors = $field->validate($value);
                if (! empty($fieldErrors)) {
                    $this->errors[$field->getName()] = $fieldErrors;
                }
            }
        }

        return empty($this->errors);
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public function setPreviousValues(array $data): void
    {
        foreach ($this->fields as $field) {
            if ($field instanceof FormFieldInterface) {
                $value = $data[$field->getName()] ?? null;

                if (! is_string($value)) {
                    continue;
                }

                $field->setValue($value);
            }
        }
    }

    public function render(): string
    {
        $html = "<form method=\"POST\" action=\"{$this->action}\">";
        $html .= csrf_field();

        foreach ($this->fields as $field) {
            if ($field instanceof FormFieldInterface) {
                $html .= $field->render();
            }

            if (! empty($this->errors[$field->getName()])) {
                $firstError = array_values($this->errors[$field->getName()])[0];
                $html .= "<small style=\"color: red;\">{$firstError}</small>";
            }
        }

        $html .= '<input type="submit" value="Wyślij" />';

        return $html.'</form>';
    }
}
