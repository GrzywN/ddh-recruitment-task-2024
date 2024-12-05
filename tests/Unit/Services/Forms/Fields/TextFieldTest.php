<?php

namespace Tests\Unit\Services\Forms\Fields;

use App\Services\Forms\Fields\TextField;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class TextFieldTest extends TestCase
{
    #[Test]
    public function it_renders_basic_text_input(): void
    {
        $field = new TextField(
            name: 'test',
            validators: [],
            required: false,
            placeholder: 'test-placeholder',
            class: 'test-class',
        );
        $field->setValue('test-value');

        $expected = '<input type="text" name="test" class="test-class" value="test-value" placeholder="test-placeholder" >';
        $this->assertEquals($expected, $field->render());
    }

    #[Test]
    public function it_renders_required_text_input(): void
    {
        $field = new TextField(
            name: 'test',
            validators: [],
            required: true,
            placeholder: 'test-placeholder',
            class: 'test-class',
        );
        $field->setValue('test-value');

        $expected = '<input type="text" name="test" class="test-class" value="test-value" placeholder="test-placeholder" required>';
        $this->assertEquals($expected, $field->render());
    }
}
