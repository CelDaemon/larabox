<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DiscoveryTest extends TestCase
{
    use RefreshDatabase;

    public function test_discovery_screen_can_be_rendered()
    {
    	$this->seed();
        $this->get(route('discovery'))->assertSuccessful();
    }
}
