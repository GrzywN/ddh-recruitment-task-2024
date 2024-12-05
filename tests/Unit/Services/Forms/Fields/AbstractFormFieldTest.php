<?php

namespace Tests\Unit\Services\Forms\Fields;

use App\Services\Forms\Contracts\FormFieldValidatorInterface;
use App\Services\Forms\Fields\AbstractFormField;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class AbstractFormFieldTest extends TestCase
{
    #[Test]
    public function it_returns_field_name(): void
    {
        $field = new class('test-field', []) extends AbstractFormField
        {
            public function render(): string
            {
                return '';
            }
        };

        $this->assertEquals('test-field', $field->getName());
    }

    #[Test]
    public function it_sets_and_escapes_value(): void
    {
        $field = new class('test-field', []) extends AbstractFormField
        {
            public function render(): string
            {
                return '';
            }
        };

        $field->setValue('<script>alert("test")</script>');
        $reflectionClass = new \ReflectionClass(AbstractFormField::class);
        $valueProperty = $reflectionClass->getProperty('value');
        $valueProperty->setAccessible(true);

        $this->assertEquals('&lt;script&gt;alert(&quot;test&quot;)&lt;/script&gt;', $valueProperty->getValue($field));
    }

    #[Test]
    public function it_handles_null_value(): void
    {
        $field = new class('test-field', []) extends AbstractFormField
        {
            public function render(): string
            {
                return '';
            }
        };
        $field->setValue(null);

        $reflectionClass = new \ReflectionClass(AbstractFormField::class);
        $valueProperty = $reflectionClass->getProperty('value');
        $valueProperty->setAccessible(true);

        $this->assertEquals($valueProperty->getValue($field), '');
    }

    #[Test]
    public function it_validates_field_value(): void
    {
        $validator = new class implements FormFieldValidatorInterface
        {
            public function validate(mixed $value): ?string
            {
                return $value === 'test' ? null : 'Invalid value';
            }
        };

        $field = new class('test-field', [$validator]) extends AbstractFormField
        {
            public function render(): string
            {
                return '';
            }
        };

        $this->assertEquals([], $field->validate('test'));
        $this->assertEquals(['Invalid value'], $field->validate('invalid'));
    }
}
