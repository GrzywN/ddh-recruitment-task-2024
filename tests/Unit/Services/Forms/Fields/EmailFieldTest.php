<?php

namespace Tests\Unit\Services\Forms\Fields;

use App\Services\Forms\Fields\EmailField;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class EmailFieldTest extends TestCase
{
    #[Test]
    public function it_renders_basic_email_input(): void
    {
        $field = new EmailField(
            name: 'test',
            validators: [],
            required: false,
            placeholder: 'test-placeholder',
            class: 'test-class',
        );
        $field->setValue('test-value');

        $expected = '<input type="email" name="test" class="test-class" value="test-value" placeholder="test-placeholder" >';
        $this->assertEquals($expected, $field->render());
    }

    #[Test]
    public function it_renders_required_email_input(): void
    {
        $field = new EmailField(
            name: 'test',
            validators: [],
            required: true,
            placeholder: 'test-placeholder',
            class: 'test-class',
        );
        $field->setValue('test-value');

        $expected = '<input type="email" name="test" class="test-class" value="test-value" placeholder="test-placeholder" required>';
        $this->assertEquals($expected, $field->render());
    }
}
