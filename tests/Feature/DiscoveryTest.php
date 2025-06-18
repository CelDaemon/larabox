<?php

namespace Tests\Feature;

use Tests\TestCase;

class DiscoveryTest extends TestCase
{
    public function test_discovery_screen_can_be_rendered()
    {
        $this->get(route('discovery'))->assertSuccessful();
    }
}
