<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Tests\TestCase;

class AuthenticatedSessionTest extends TestCase
{
    use RefreshDatabase;
    public function test_login_authenticated()
    {
        $this->post(route('session.store'), [
            ...User::factory()->create()->only('email'),
            'password' => UserFactory::password
        ])->assertValid();
        $this->assertAuthenticated();
    }
    public function test_logout_unauthenticated()
    {
        $this->actingAs(User::factory()->create())->delete(route('session.destroy'));
        $this->assertGuest();
    }
    public function test_login_incorrect_credentials_returns_an_invalid_response()
    {
        $this->post(route('session.store'), [
            ...User::factory()->create()->only('email'),
            'password' => 'incorrect'
        ])->assertInvalid(['email' => 'These credentials do not match our records.']);
    }
    public function test_login_incorrect_credentials_with_too_many_attempts_returns_an_invalid_response()
    {
        $user = User::factory()->create(['password' => 'password1']);
        RateLimiter::increment(Str::transliterate(Str::lower($user->email).'|127.0.0.1'), amount: 5);
        $this->post(route('session.store'), [
            ...$user->only('email'),
            'password' => 'password2'
        ])->assertInvalid(['email' => 'Too many login attempts.']);
    }
}
