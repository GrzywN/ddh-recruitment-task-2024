<?php

namespace Tests\Unit\Services\Forms;

use App\Services\Forms\Fields\AbstractFormField;
use App\Services\Forms\Fields\EmailField;
use App\Services\Forms\Form;
use App\Services\Forms\Validators\EmailValidator;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class ExampleField extends AbstractFormField
{
    #[\Override]
    public function getName(): string
    {
        return $this->name;
    }

    #[\Override]
    public function render(): string
    {
        return '';
    }

    #[\Override]
    public function validate(mixed $value): array
    {
        return [];
    }
}

class FormTest extends TestCase
{
    private Form $form;

    #[\Override]
    protected function setUp(): void
    {
        $this->form = new Form('/test-action');
    }

    #[Test]
    public function it_adds_and_retrieves_field(): void
    {
        $field = new ExampleField('test-field', []);

        $this->form->addField($field);

        $this->assertSame($field, $this->form->getField('test-field'));
        $this->assertNull($this->form->getField('non-existent'));
    }

    #[Test]
    public function it_validates_form_data(): void
    {
        $field1 = new ExampleField('field1', []);
        $field2 = new ExampleField('field2', []);

        $this->form->addField($field1)->addField($field2);

        $data = ['field1' => 'value1', 'field2' => 'value2'];
        $isValid = $this->form->validate($data);
        $this->assertTrue($isValid);
    }

    #[Test]
    public function it_sets_previous_values(): void
    {
        $field = new ExampleField('test-field', []);

        $this->form->addField($field);
        $this->form->setPreviousValues(['test-field' => 'test-value']);

        $reflectionClass = new \ReflectionClass(AbstractFormField::class);
        $valueProperty = $reflectionClass->getProperty('value');
        $valueProperty->setAccessible(true);

        $this->assertEquals('test-value', $valueProperty->getValue($field));
    }

    #[Test]
    public function it_renders_form(): void
    {
        $field = new ExampleField('test-field', []);

        $this->form->addField($field);

        $this->assertEquals('<form method="POST" action="/test-action"><input type="submit" value="Wyślij" /></form>', $this->form->render(withCSRF: false));
    }

    #[Test]
    public function it_renders_form_with_errors(): void
    {
        // TODO: Make it independent from EmailField and EmailValidator
        $field = new EmailField('invalid-email-field', [new EmailValidator('email')]);

        $this->form->addField($field);
        $this->form->validate(['invalid-email-field' => 'localhost']);

        $this->assertEquals('<form method="POST" action="/test-action"><input type="email" name="invalid-email-field" class="" value="localhost" placeholder="" ><small style="color: red;">Pole email musi być poprawnym adresem email.</small><input type="submit" value="Wyślij" /></form>', $this->form->render(withCSRF: false));
    }
}
