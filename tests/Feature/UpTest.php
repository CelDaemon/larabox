<?php

namespace Tests\Feature;

use Tests\TestCase;

class UpTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_up_route_returns_a_successful_response(): void
    {
        $this->get('/up')->assertSuccessful();
    }
}
