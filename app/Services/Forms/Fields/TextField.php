<?php

namespace App\Services\Forms\Fields;

class TextField extends AbstractFormField
{
    #[\Override]
    public function render(): string
    {
        $required = $this->required ? 'required' : '';

        return sprintf(
            '<input type="text" name="%s" class="%s" value="%s" placeholder="%s" %s>',
            $this->name,
            $this->class,
            $this->value,
            $this->placeholder,
            $required,
        );
    }
}
