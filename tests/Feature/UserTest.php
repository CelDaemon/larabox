<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    public function test_register_screen_can_be_rendered()
    {
        $this->get(route('register'))->assertSuccessful();
    }
    public function test_user_can_register()
    {
        $user = User::factory()->raw();
        $this->post(route('users.store'), [
            'name' => $user['name'],
            'email' => $user['email'],
            'password' => $user['password'],
            'password_confirmation' => $user['password']
        ]);
        $this->assertAuthenticated();
    }
    public function test_user_can_delete_their_account()
    {
        $user = User::factory()->create();
        $this->actingAs($user)->delete(route('users.destroy', ['user' => $user]));
        $this->assertGuest();
    }
    public function test_settings_screen_can_be_rendered()
    {
        $user = User::factory()->create();
        $this->actingAs($user)->get(route('settings'))->assertSuccessful();
    }
    public function test_user_can_update_their_account()
    {
        $user = User::factory()->create();
        $newUser = User::factory()->raw();
        $this->actingAs($user)->patch(route('users.update', ['user' => $user]), [
            'name' => $newUser['name'],
            'email' => $newUser['email']
        ]);
        $user->refresh();
        $this->assertSame($newUser['name'], $user->name);
        $this->assertSame($newUser['email'], $user->email);
        $this->assertNull($user->email_verified_at);
    }
    public function test_updating_without_email_keeps_verification()
    {
        $user = User::factory()->create();
        $newUser = User::factory()->raw();
        $this->actingAs($user)->patch(route('users.update', ['user' => $user]), [
            'name' => $newUser['name'],
            'email' => $user->email
        ]);
        $user->refresh();
        $this->assertSame($newUser['name'], $user->name);
        $this->assertNotNull($user->email_verified_at);
    }
    public function test_user_can_update_password()
    {
        $user = User::factory()->create();
        $newUser = User::factory()->raw();
        $this->actingAs($user)->patch(route('users.update-password', ['user' => $user]), [
            'current_password' => UserFactory::password,
            'password' => $newUser['password'],
            'password_confirmation' => $newUser['password']
        ])->assertValid();
    }
}
