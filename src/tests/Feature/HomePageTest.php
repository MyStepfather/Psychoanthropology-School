<?php

namespace Tests\Feature;

use Tests\TestCase;

class HomePageTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testHomePageStatus(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
