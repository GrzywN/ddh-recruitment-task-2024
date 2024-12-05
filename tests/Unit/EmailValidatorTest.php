<?php

namespace Tests\Unit;

use App\Services\Forms\Validators\EmailValidator;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class EmailValidatorTest extends TestCase
{
    private const string DISPLAY_NAME = 'Field';

    #[Test]
    public function it_returns_null_for_valid_email(): void
    {
        $validator = new EmailValidator(self::DISPLAY_NAME);
        $this->assertNull($validator->validate('test@example.com'));
    }

    #[Test]
    public function it_returns_error_message_for_invalid_email(): void
    {
        $validator = new EmailValidator(self::DISPLAY_NAME);
        $this->assertEquals(
            'Pole Field musi być poprawnym adresem email.',
            $validator->validate('invalid-email')
        );
    }

    #[Test]
    public function it_returns_error_message_for_non_string_value(): void
    {
        $validator = new EmailValidator(self::DISPLAY_NAME);
        $this->assertEquals(
            'Pole Field musi być poprawnym adresem email.',
            $validator->validate(123)
        );
    }
}
