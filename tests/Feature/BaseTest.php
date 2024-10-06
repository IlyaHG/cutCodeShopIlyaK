<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BaseTest extends TestCase
{
	use RefreshDatabase;

	public function testHomePageStatus()
	{
		$response = $this->get('/');

		$response->assertStatus(200);
	}
	public function testLoginPageStatus()
	{
		$response = $this->get('/login');
		$response->assertStatus(200);
		$response->assertSee('Вход в аккаунт');
	}
	public function testRegisterPageStatus()
	{
		$response = $this->get('/register');
		$response->assertStatus(200);
		$response->assertSee('Регистрация');
	}

	public function testForgotPasswordPageStatus()
	{
		$response = $this->get('/forgot-password');
		$response->assertStatus(200);
		$response->assertSee('Забыли пароль');
	}
}
