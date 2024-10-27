<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Tests\TestCase;

class AuthTest extends TestCase
{

	public function test_user_can_register()
	{
		Event::fake();

		$data = [
			'name' => 'Vasya',
			'email' => 'check@email.com',
			'password' => 'pass',
			'password_confirmation' => 'pass',
		];
		$response = $this->post('/register-process', $data);
		$response->assertRedirect(route('homePage'));

		$this->assertDatabaseHas('users', [
			'name' => 'Vasya',
			'email' => 'check@email.com',
		]);

		Event::assertDispatched(Registered::class);

	}

	public function test_user_can_login()
	{
		$user = User::where('name','Vasya')->first();

		$login_data = [
			'email' => 'check@email.com',
			'password' => 'pass',
		];

		$response = $this->post('/login-process', $login_data);

		$response->assertRedirect(route('homePage'));

		$this->assertAuthenticatedAs($user);
	}
}
