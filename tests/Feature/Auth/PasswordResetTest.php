<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class PasswordResetTest extends TestCase
{
    use RefreshDatabase;
    public function test_reset_password_request_screen_can_be_rendered()
    {
        $this->get(route('password.request'))->assertSuccessful();
    }
    public function test_reset_password_link_can_be_requested()
    {
        Notification::fake();
        $user = User::factory()->create();
        $this->post(route('password.email'), ['email' => $user->email]);
        Notification::assertSentTo($user, ResetPassword::class);
    }
    public function test_reset_password_screen_can_be_rendered()
    {
        Notification::fake();
        $user = User::factory()->create();
        $this->post(route('password.email'), ['email' => $user->email]);

        Notification::assertSentTo($user, ResetPassword::class, function (ResetPassword $notification) use ($user) {
            $this->get(route('password.reset', ['token' => $notification->token, 'email' => $user->email]))->assertSuccessful();
            return true;
        });
    }
    public function test_password_can_be_reset()
    {
        Notification::fake();
        $user = User::factory()->create();
        $this->post(route('password.email'), ['email' => $user->email]);

        Notification::assertSentTo($user, ResetPassword::class, function (ResetPassword $notification) use ($user) {
            Event::fake();
            $this->post(route('password.update', [
                'token' => $notification->token,
                'email' => $user->email,
                'password' => UserFactory::password,
                'password_confirmation' => UserFactory::password
            ]));
            Event::assertDispatched(PasswordReset::class);
            return true;
        });
    }
}
