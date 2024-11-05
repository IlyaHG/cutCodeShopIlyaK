<?php

namespace Tests\Feature\App\HTTP\Controllers;

use App\Http\Requests\RegisterFormRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Notification;
use Tests\TestCase;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Artisan;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @return void
     */
    public function it_register_success(): void
    {
        Notification::fake();
        Event::fake();

        $data = [
            'email' => 'assss@gmail.com',
            'name' => 'test=test',
            'password' => 'test-test-test123',
            'password_confirmation' => 'test-test-test123',
        ];

        $response = $this->post(action([AuthController::class, 'register']), $data);

        $response->assertRedirect(route('homePage'));
    }

}
