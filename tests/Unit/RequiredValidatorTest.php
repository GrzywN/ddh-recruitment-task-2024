<?php

namespace Tests\Unit;

use App\Services\Forms\Validators\RequiredValidator;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class RequiredValidatorTest extends TestCase
{
    private const string DISPLAY_NAME = 'Field';

    #[Test]
    public function it_returns_null_for_non_empty_value(): void
    {
        $validator = new RequiredValidator(self::DISPLAY_NAME);
        $this->assertNull($validator->validate('test'));
        $this->assertNull($validator->validate(['test']));
        $this->assertNull($validator->validate(0));
        $this->assertNull($validator->validate(false));
    }

    #[Test]
    public function it_returns_error_message_for_empty_value(): void
    {
        $validator = new RequiredValidator(self::DISPLAY_NAME);
        $this->assertEquals(
            'Pole Field jest wymagane.',
            $validator->validate('')
        );
        $this->assertEquals(
            'Pole Field jest wymagane.',
            $validator->validate([])
        );
        $this->assertEquals(
            'Pole Field jest wymagane.',
            $validator->validate(null)
        );
    }
}
