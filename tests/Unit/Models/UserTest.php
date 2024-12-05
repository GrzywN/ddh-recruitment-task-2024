<?php

namespace Tests\Unit\Models;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_has_fillable_attributes(): void
    {
        $user = new User;

        $this->assertEquals(
            ['name', 'email', 'password'],
            $user->getFillable()
        );
    }

    #[Test]
    public function it_has_hidden_attributes(): void
    {
        $user = new User;

        $this->assertEquals(
            ['password', 'remember_token'],
            $user->getHidden()
        );
    }

    #[Test]
    public function it_has_casted_attributes(): void
    {
        $user = new User;

        $this->assertEquals(
            [
                'email_verified_at' => 'datetime',
                'password' => 'hashed',
                'id' => 'int',
            ],
            $user->getCasts()
        );
    }

    #[Test]
    public function it_can_create_user_via_factory(): void
    {
        $user = User::factory()->create();

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'email' => $user->email,
            'name' => $user->name,
        ]);
    }
}
