<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SettingsTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_settings_page_returns_success(): void
    {
        $this->actingAs(User::factory()->create())->get(route('settings'))->assertSuccessful();
    }
}
