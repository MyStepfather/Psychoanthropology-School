<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testLoginProcess(): void
    {
        $data = [
            'email' => '79262812867@ya.ru',
            'password' => '111',
        ];

        $response = $this->post(route('login.process'), $data);

        $response->assertStatus(302); // Ожидаемый HTTP-статус 302 (перенаправление)
        $response->assertRedirect('/'); // Ожидаемое перенаправление на указанный URL

    }

    public function testProcessStep1(): void
    {
        $data = [
            'email' => 'example@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ];

        $response = $this->post(route('process.step1'), $data);

        $response->assertStatus(302); // Ожидаемый HTTP-статус 302 (перенаправление)
        $response->assertRedirect(route('show.step2')); // Ожидаемое перенаправление на указанный URL

        //$this->assertAuthenticated(); // Проверка, что пользователь аутентифицирован

        $this->assertDatabaseHas('users', ['email' => 'example@example.com']); // Проверка наличия пользователя в базе данных
        $this->assertEquals('example@example.com', session('email'));
    }

    public function testProcessStep2()
    {
        Session::put('email', 'test@example.com');
        $user = User::whereEmail('test@example.com')->first();

        $response = $this->post(route('process.step2'), [
            'name_first' => 'Вероника',
            'name_last' => 'Прекрасная',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('show.step3'));

        $user->refresh(); // Обновление модели пользователя из базы данных

        $this->assertEquals('Вероника', $user->name_first);
        $this->assertEquals('Прекрасная', $user->name_last);

    }

    public function testProcessStep3()
    {
        Session::put('email', 'test@example.com');
        $user = User::whereEmail('test@example.com')->first();

        $response = $this->post(route('process.step3'), [
            'country_id' => 1,
            'day' => 4,
            'month' => 2,
            'year' => 2020,
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('show.step4'));

        $user->refresh(); // Обновление модели пользователя из базы данных

        $this->assertEquals('2020-02-04', $user->entered_at);
        $this->assertNull($user->group_id);
    }

    public function testProcessStep4()
    {
        Session::put('email', 'test@example.com');
        $user = User::whereEmail('test@example.com')->first();

        $response = $this->post(route('process.step4'), [
            'phone' => '123456789',
            'agree_contact' => true,
            'agree_policy' => true,
        ]);

        $response->assertViewIs('auth.registerSuccess');
        $response->assertStatus(200);

        $user->refresh(); // Обновление модели пользователя из базы данных

        $this->assertEquals('123456789', $user->phone);
        $this->assertNull($user->telegram);
    }
}
