<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;
    public function test_login_screen_can_be_rendered()
    {
        $this->get(route('login'))->assertSuccessful();
    }
    public function test_user_can_login()
    {
        $user = User::factory()->create();
        $this->post(route('session.store'), [
            'email' => $user->email,
            'password' => UserFactory::password
        ]);
        $this->assertAuthenticated();
    }
    public function test_user_can_logout()
    {
        $this->actingAs(User::factory()->create())->delete(route('session.destroy'));
        $this->assertGuest();
    }
    public function test_user_cannot_login_with_incorrect_credentials()
    {
        $user = User::factory()->create();
        $this->post(route('session.store'), [
            'email' => $user->email,
            'password' => 'incorrect'
        ]);
        $this->assertGuest();
    }
    public function test_user_cannot_login_after_too_many_attempts()
    {
        $user = User::factory()->create();
        RateLimiter::increment(Str::transliterate(Str::lower($user->email).'|127.0.0.1'), amount: 5);
        $this->post(route('session.store'), [
            'email' => $user->email,
            'password' => UserFactory::password
        ]);
        $this->assertGuest();
    }
}
