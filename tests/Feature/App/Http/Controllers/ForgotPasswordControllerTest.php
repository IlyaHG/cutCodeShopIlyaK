<?php

namespace Tests\Feature\App\Http\Controllers;

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Domain\Auth\Models\User;
use App\Http\Controllers\Auth\ForgotPasswordController;

class ForgotPasswordControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @return void
     */
    public function it_forgot_password_page_success(): void
    {
        $this->get('/forgot-password')
            ->assertOk()
            ->assertSee('Забыли пароль')
            ->assertViewIs('auth.forgot-password');

    }

}
