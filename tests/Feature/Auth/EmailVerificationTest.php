<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class EmailVerificationTest extends TestCase
{
    use RefreshDatabase;
    public function test_verification_page_returns_success()
    {
        $this->actingAs(User::factory()->create())->get(route('verification.notice'))->assertSuccessful();
    }
    public function test_send_returns_status_and_sends_notification()
    {
        Notification::fake();
        $user = User::factory()->create();
        $this->actingAs($user)->post(route('verification.send'))->assertSessionHas('status');
        Notification::assertSentTo($user, VerifyEmail::class);
    }
    public function test_verify_returns_redirect()
    {
        $user = User::factory()->create();
        $this->actingAs($user)->get(URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
            [
                'id' => $user->getKey(),
                'hash' => sha1($user->getEmailForVerification()),
            ]
        ))->assertRedirect();
    }
}
