<?php

namespace App\Services\Forms\Fields;

class TextareaField extends AbstractFormField
{
    #[\Override]
    public function render(): string
    {
        $required = $this->required ? 'required' : '';
        $value = $this->value ?? '';

        return sprintf(
            '<textarea name="%s" class="%s" placeholder="%s" %s>%s</textarea>',
            $this->name,
            $this->class,
            $this->placeholder,
            $required,
            $value
        );
    }
}
