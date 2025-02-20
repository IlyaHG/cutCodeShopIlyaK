<?php

namespace Tests\Feature\App\Http\Controllers;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Requests\RegisterFormRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Illuminate\Testing\TestResponse;
use Tests\RequestFactories\RegisterRequestFactory;
use Tests\TestCase;
use Domain\Auth\Models\User;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use App\Listeners\SendEmailToNewUserListener;
use App\Notifications\NewUserNotification;

class RegisterControllerTest extends TestCase
{
    use RefreshDatabase;

    protected array $request;

    protected function setUp(): void
    {
        parent::setUp();

        $this->request = RegisterRequestFactory::new()->create([
            'email' => 'john@example.com',
            'password' => '12345678',
            'password_confirmation' => '12345678',
        ]);
    }

    private function request(): TestResponse
    {
        return  $this->post(
            action([RegisterController::class, 'handle']),
            $this->request
        );
    }

    private function findUser(): \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
    {
        return User::query()
            ->where('email', $this->request['email'])
            ->firstOrFail();
    }




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

    public function it_should_fail_validation_on_password_confirm(): void
    {
        $this->request['password'] = '12345678';
        $this->request['password_confirmation'] = '1234567890';

        $this->request()->assertInvalid(['password']);
    }

    public function it_validation_success()
    {
        $this->request()->assertValid();
    }
    public function it_register_success(): void
    {
        Notification::fake();
        Event::fake();



        $data = RegisterRequestFactory::new()->create();

        // Добавьте подтверждение пароля, совпадающее с паролем
        $data['password_confirmation'] = $data['password'];

        // Проверяем, что пользователь еще не существует в базе
        $this->assertDatabaseMissing('users', ['email' => $data['email']]);

        // Отправляем запрос на регистрацию
        $response = $this->post(action([RegisterController::class, 'handle']), $data);

        // Проверяем, что запрос прошел валидацию
        $response->assertValid();

        // Проверяем, что пользователь появился в базе данных
        $this->assertDatabaseHas('users', ['email' => $data['email']]);

        // Проверка событий
        Event::assertDispatched(Registered::class);
        Event::assertListening(Registered::class, SendEmailToNewUserListener::class);

        // Обработка события
        $user = User::query()->where('email', $data['email'])->first();
        $event = new Registered($user);
        $listener = new SendEmailToNewUserListener();
        $listener->handle($event);

        // Проверка, что уведомление было отправлено
        Notification::assertSentTo($user, NewUserNotification::class);

        // Проверка аутентификации
        $this->assertAuthenticatedAs($user);

        // Проверка редиректа на главную страницу
        $response->assertRedirect(route('homePage'));
    }


}
