<?php

namespace Tests\Unit;

use App\Services\Forms\Validators\MinLengthValidator;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class MinLengthValidatorTest extends TestCase
{
    private const string DISPLAY_NAME = 'Field';

    #[Test]
    public function it_returns_null_for_non_string_value(): void
    {
        $validator = new MinLengthValidator(self::DISPLAY_NAME, 10);
        $this->assertNull($validator->validate(100));
    }

    #[Test]
    public function it_returns_null_for_valid_length(): void
    {
        $validator = new MinLengthValidator(self::DISPLAY_NAME, 10);
        $this->assertNull($validator->validate('1234567890'));
    }

    #[Test]
    public function it_returns_error_message_for_exceeding_length(): void
    {
        $validator = new MinLengthValidator(self::DISPLAY_NAME, 10);
        $this->assertEquals('Pole Field musi mieć co najmniej 10 znaków.', $validator->validate('Hello'));
    }
}
