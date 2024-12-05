<?php

namespace Tests\Unit\Services\Forms\Fields;

use App\Services\Forms\Fields\TextareaField;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class TextareaFieldTest extends TestCase
{
    #[Test]
    public function it_renders_basic_textarea_input(): void
    {
        $field = new TextareaField(
            name: 'test',
            validators: [],
            required: false,
            placeholder: 'test-placeholder',
            class: 'test-class',
        );
        $field->setValue('test-value');

        $expected = '<textarea name="test" class="test-class" placeholder="test-placeholder" >test-value</textarea>';
        $this->assertEquals($expected, $field->render());
    }

    #[Test]
    public function it_renders_required_textarea_input(): void
    {
        $field = new TextareaField(
            name: 'test',
            validators: [],
            required: true,
            placeholder: 'test-placeholder',
            class: 'test-class',
        );
        $field->setValue('test-value');

        $expected = '<textarea name="test" class="test-class" placeholder="test-placeholder" required>test-value</textarea>';
        $this->assertEquals($expected, $field->render());
    }
}
