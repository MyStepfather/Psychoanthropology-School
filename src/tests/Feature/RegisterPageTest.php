<?php

namespace Tests\Feature;

use Tests\TestCase;

class RegisterPageTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testLoginStatus(): void
    {
        $response = $this->get(route('login'));

        $response->assertStatus(200);
    }

    public function testRegisterStep1Status(): void
    {
        $response = $this->get(route('show.step1'));

        $response->assertStatus(200);
    }

    public function testRegisterStep2Status(): void
    {
        $response = $this->get(route('show.step2'));

        $response->assertStatus(200);
    }

    public function testRegisterStep3Status(): void
    {
        $response = $this->get(route('show.step3'));

        $response->assertStatus(200);
    }

    public function testRegisterStep4Status(): void
    {
        $response = $this->get(route('show.step4'));

        $response->assertStatus(200);
    }
}
