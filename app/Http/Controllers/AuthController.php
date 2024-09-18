<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginFormRequest;
use App\Http\Requests\RegisterFormRequest;
use App\Http\Requests\ForgotPasswordFormRequest;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;


class AuthController extends Controller
{
	public function showLogin()
	{
		return view("auth.login");
	}

	public function showRegister()
	{
		return view("auth.sign-up");
	}

	public function showForgotPassword()
	{
		return view("auth.forgot-password");

	}

	public function login(LoginFormRequest $request): RedirectResponse
	{
		if (!auth('web')->attempt($request->only('email', 'password'))) {
			return redirect(route('login'))->withErrors(
				[
					'email' => 'Пользователь не найден, либо данные введены не правильно'
				]
			)->onlyInput('email');
		}

		$request->session()->regenerate();

		return redirect()->intended(route('homePage'));

	}

	public function register(RegisterFormRequest $request): RedirectResponse
	{
		$data = $request->all();

		$data['password'] = Hash::make($data['password']);

		$user = User::create($data);

		event(new Registered($user));

		if ($user) {
			auth('web')->login($user);
		}

		return redirect()->route('homePage');
	}
	public function logout(): RedirectResponse
	{

		auth()->logout();

		request()->session()->invalidate();

		request()->session()->regenerateToken();

		return redirect(route('login'));

	}

	public function forgotPasswordProcess(ForgotPasswordFormRequest $request)
	{

		$request->validate(['email' => 'required|email']);

		$status = Password::sendResetLink(
			$request->only('email')
		);

		return $status === Password::RESET_LINK_SENT
			? back()->with(['status' => __($status)])
			: back()->withErrors(['email' => __($status)]);

	}
}
