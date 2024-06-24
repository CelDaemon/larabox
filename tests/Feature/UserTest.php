<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    public function test_creating_user_adds_to_users_table()
    {
        $this->post(route('users.store'),
            User::factory()->raw(fn ($data) => [...$data, 'password_confirmation' => $data['password']]));
        $this->assertDatabaseCount(User::class, 1);
    }
    public function test_deleting_user_removes_from_users_table()
    {
        $user = User::factory()->create();
        $this->actingAs($user)->delete(route('users.destroy', ['user' => $user]));
        $this->assertDatabaseEmpty(User::class);
    }
    public function test_updating_user_returns_a_valid_response()
    {
        $user = User::factory()->create();
        $this->actingAs($user)
            ->put(route('users.update', ['user' => $user]),
                User::factory()->raw(['name', 'email']))
            ->assertValid();
    }
}
