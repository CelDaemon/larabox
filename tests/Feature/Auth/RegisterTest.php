<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;

class RegisterTest extends TestCase
{
    public function test_register_page_returns_success()
    {
        $this->get(route('register'))->assertSuccessful();
    }
}
