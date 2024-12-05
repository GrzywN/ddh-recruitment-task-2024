<?php

namespace Tests\Unit;

use App\Services\Forms\Validators\MaxLengthValidator;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class MaxLengthValidatorTest extends TestCase
{
    private const string DISPLAY_NAME = 'Field';

    #[Test]
    public function it_returns_null_for_non_string_value(): void
    {
        $validator = new MaxLengthValidator(self::DISPLAY_NAME, 10);
        $this->assertNull($validator->validate(100));
    }

    #[Test]
    public function it_returns_null_for_valid_length(): void
    {
        $validator = new MaxLengthValidator(self::DISPLAY_NAME, 10);
        $this->assertNull($validator->validate('Hello'));
    }

    #[Test]
    public function it_returns_error_message_for_exceeding_length(): void
    {
        $validator = new MaxLengthValidator(self::DISPLAY_NAME, 10);
        $this->assertEquals('Pole Field nie może być dłuższe niż 10 znaków.', $validator->validate('Hello World'));
    }
}
