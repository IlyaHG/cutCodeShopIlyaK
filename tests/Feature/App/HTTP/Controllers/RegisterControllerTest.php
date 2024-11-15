<?php

namespace Tests\Feature\App\HTTP\Controllers;

use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Domain\Auth\Models\User;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Notification;
use App\Listeners\SendEmailToNewUserListener;
use App\Notifications\NewUserNotification;

class RegisterControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @return void
     */

    public function it_register_page_success(): void
    {
        $this->get(action([RegisterController::class, 'page']))
            ->assertOk()
            ->assertSee('Регистрация')
            ->assertViewIs('auth.register');
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

        $response = $this->post(action([RegisterController::class, 'handle']), $data);

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

}
