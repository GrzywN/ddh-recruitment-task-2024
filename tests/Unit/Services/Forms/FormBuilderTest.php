<?php

namespace Tests\Unit\Services\Forms;

use App\Services\Forms\Fields\EmailField;
use App\Services\Forms\Fields\TextareaField;
use App\Services\Forms\Fields\TextField;
use App\Services\Forms\Form;
use App\Services\Forms\FormBuilder;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class FormBuilderTest extends TestCase
{
    private FormBuilder $builder;

    #[\Override]
    protected function setUp(): void
    {
        $this->builder = new FormBuilder('/test-action');
    }

    #[Test]
    public function it_builds_form(): void
    {
        $form = $this->builder->build();
        $this->assertInstanceOf(Form::class, $form);
    }

    #[Test]
    public function it_adds_text_field(): void
    {
        $form = $this->builder
            ->addTextField('name', true, [], 'Enter name', '')
            ->build();

        $field = $form->getField('name');
        $this->assertInstanceOf(TextField::class, $field);
    }

    #[Test]
    public function it_adds_email_field(): void
    {
        $form = $this->builder
            ->addEmailField('email', true, [], 'Enter email', '')
            ->build();

        $field = $form->getField('email');
        $this->assertInstanceOf(EmailField::class, $field);
    }

    #[Test]
    public function it_adds_textarea_field(): void
    {
        $form = $this->builder
            ->addTextareaField('message', true, [], 'Enter message', '')
            ->build();

        $field = $form->getField('message');
        $this->assertInstanceOf(TextareaField::class, $field);
    }
}
