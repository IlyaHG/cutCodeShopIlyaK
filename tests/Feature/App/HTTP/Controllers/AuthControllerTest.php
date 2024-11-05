<?php

namespace Tests\Feature\App\HTTP\Controllers;

use App\Http\Requests\RegisterFormRequest;
use App\Listeners\SendEmailToNewUserListener;
use App\Notifications\NewUserNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Notification;
use Tests\TestCase;
use App\Http\Controllers\AuthController;
use App\Models\User;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @return void
     */

    public function it_login_page_success(): void
    {
        $this->get(action([AuthController::class, 'showLogin']))
            ->assertOk()
            ->assertSee('Вход в аккаунт')
            ->assertViewIs('auth.login');
    }

    /**
     * @test
     * @return void
     */

    public function it_register_page_success(): void
    {
        $this->get(action([AuthController::class, 'showRegister']))
            ->assertOk()
            ->assertSee('Регистрация')
            ->assertViewIs('auth.sign-up');
    }
    /**
     * @test
     * @return void
     */
    public function it_forgot_password_page_success(): void
    {
        $this->get(action([AuthController::class, 'showForgotPassword']))
            ->assertOk()
            ->assertSee('Забыли пароль')
            ->assertViewIs('auth.forgot-password');
    }
    /**
     * @test
     * @return void
     */
    public function it_register_success(): void
    {
        Notification::fake();
        Event::fake();


        $data = [
            'email' => 'kurat.ilya@gmail.com',
            'name' => 'Test',
            'password' => 'test-test-test123',
            'password_confirmation' => 'test-test-test123',
        ];

        $this->assertDatabaseMissing('users', ['email' => $data['email']]);

        $response = $this->post(action([AuthController::class, 'register']), $data);

        $user = User::query()->where('email', $data['email'])->first();

        $response->assertValid();

        $this->assertDatabaseHas('users', ['email' => $data['email']]);

        Event::assertDispatched(Registered::class);
        Event::assertListening(Registered::class, SendEmailToNewUserListener::class);

        $event = new Registered($user);
        $listener = new SendEmailToNewUserListener();
        $listener->handle($event);

        Notification::assertSentTo($user, NewUserNotification::class);

        $this->assertAuthenticatedAs($user);

        $response->assertRedirect(route('homePage'));
    }

    /**
     * @test
     * @return void
     */
    public function it_login_success(): void
    {

        $password = "123456789";
        $user = User::factory()->create([
            'password' => bcrypt($password)
        ]);

        $data = [
            'email' => $user->email,
            'password' => $password,
        ];

        $response = $this->post(action([AuthController::class, 'login']), $data);

        $response->assertValid()
            ->assertRedirect(route('homePage'));

        $this->assertAuthenticatedAs($user);


    }

    /**
     * @test
     * @return void
     */
    public function it_logout_success()
    {
        $user = User::factory()->create(['email' => 'test@gmail.com']);

        $this->actingAs($user)->delete(action([AuthController::class,'logout']));

        $this->assertGuest();

    }

}
