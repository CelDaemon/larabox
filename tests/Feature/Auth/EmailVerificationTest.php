<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class EmailVerificationTest extends TestCase
{
    use RefreshDatabase;
    public function test_verification_screen_can_be_rendered()
    {
        $this->actingAs(User::factory()->create())->get(route('verification.notice'))->assertSuccessful();
    }
    public function test_user_can_send_a_verification_notification()
    {
        Notification::fake();
        $user = User::factory()->create();
        $this->actingAs($user)->post(route('verification.send'));
        Notification::assertSentTo($user, VerifyEmail::class);
    }
    public function test_user_can_verify_their_email()
    {
        $user = User::factory()->unverified()->create();
        Event::fake();
        $this->actingAs($user)->get(URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(60),
            [
                'id' => $user->getKey(),
                'hash' => sha1($user->getEmailForVerification()),
            ]
        ));
        Event::assertDispatched(Verified::class);
        $this->assertTrue($user->fresh()->hasVerifiedEmail());
    }
}
