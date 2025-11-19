<?php

namespace Tests\Feature;

use Tests\TestCase;

class HomePageTest extends TestCase
{
    public function test_homepage_is_accessible()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
