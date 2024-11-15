<?php

namespace Tests\Feature\App\HTTP\Controllers;

use App\Http\Controllers\Auth\LoginController;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Domain\Auth\Models\User;

class LoginControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @return void
     */

    public function it_login_page_success(): void
    {
        $this->get(action([LoginController::class, 'page']))
            ->assertOk()
            ->assertSee('Вход в аккаунт')
            ->assertViewIs('auth.login');
    }

    /**
     * @test
     * @return void
     */
    public function it_login_success(): void
    {

        $password = "123456789";

        $user = UserFactory::new()->create([
            'password' => bcrypt($password)
        ]);

        $data = [
            'email' => $user->email,
            'password' => $password,
        ];

        $response = $this->post(action([LoginController::class, 'handle']), $data);

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
        $user = UserFactory::new()->create(['email' => 'test@gmail.com']);
        $this->actingAs($user)->delete(action([LoginController::class,'logout']));
        $this->assertGuest();

    }

}
