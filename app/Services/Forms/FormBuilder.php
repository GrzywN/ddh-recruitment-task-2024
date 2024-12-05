<?php

namespace App\Services\Forms;

use App\Services\Forms\Contracts\FormFieldValidatorInterface;
use App\Services\Forms\Fields\EmailField;
use App\Services\Forms\Fields\TextareaField;
use App\Services\Forms\Fields\TextField;

class FormBuilder
{
    private readonly Form $form;

    public function __construct(string $action)
    {
        $this->form = new Form($action);
    }

    /**
     * @param  FormFieldValidatorInterface[]  $validators
     */
    public function addTextField(string $name, bool $required = false, array $validators = [], string $placeholder = '', string $class = ''): self
    {
        $this->form->addField(new TextField($name, $validators, $required, $placeholder, $class));

        return $this;
    }

    /**
     * @param  FormFieldValidatorInterface[]  $validators
     */
    public function addEmailField(string $name, bool $required = false, array $validators = [], string $placeholder = '', string $class = ''): self
    {
        $this->form->addField(new EmailField($name, $validators, $required, $placeholder, $class));

        return $this;
    }

    /**
     * @param  FormFieldValidatorInterface[]  $validators
     */
    public function addTextareaField(string $name, bool $required = false, array $validators = [], string $placeholder = '', string $class = ''): self
    {
        $this->form->addField(new TextareaField($name, $validators, $required, $placeholder, $class));

        return $this;
    }

    public function build(): Form
    {
        return $this->form;
    }
}
