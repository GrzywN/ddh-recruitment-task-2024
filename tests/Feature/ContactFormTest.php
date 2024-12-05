<?php

namespace Tests\Feature;

use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ContactFormTest extends TestCase
{
    #[Test]
    public function it_shows_contact_form(): void
    {
        $response = $this->get(route('contact-form.show'));

        $response->assertStatus(200);
        $response->assertViewIs('contact-form');
        $response->assertSee('Wpisz swoje imię');
        $response->assertSee('Wpisz swój adres email');
        $response->assertSee('Wpisz opis');
    }

    #[Test]
    public function it_validates_and_stores_valid_form_data(): void
    {
        $response = $this->post(route('contact-form.store'), [
            'first_name' => 'John',
            'email' => 'john@example.com',
            'description' => 'Test message',
        ]);

        $response->assertRedirect(route('contact-form.success'));
    }

    #[Test]
    public function it_shows_validation_errors_for_invalid_data(): void
    {
        $response = $this->post(route('contact-form.store'), [
            'first_name' => 'J', // too short
            'email' => 'invalid-email',
            'description' => str_repeat('a', 501), // too long
        ]);

        $response->assertStatus(200);
        $response->assertViewIs('contact-form');
        $response->assertSee('Pole imię musi mieć co najmniej 3 znaków');
        $response->assertSee('Pole email musi być poprawnym adresem email');
        $response->assertSee('Pole opis nie może być dłuższe niż 500 znaków');
    }

    #[Test]
    public function it_shows_success_page(): void
    {
        $response = $this->get(route('contact-form.success'));

        $response->assertStatus(200);
        $response->assertViewIs('contact-form-success');
    }
}
