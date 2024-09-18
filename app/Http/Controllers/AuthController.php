<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginFormRequest;
use App\Http\Requests\RegisterFormRequest;
use App\Http\Requests\ForgotPasswordFormRequest;
use App\Http\Requests\ResetPasswordFormRequest;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Events\Registered;
use Illuminate\Console\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;


class AuthController extends Controller
{
	public function showLogin(): Factory|View|Application
	{
		return view("auth.login");
	}

	public function showRegister(): Factory|View|Application
	{
		return view("auth.sign-up");
	}

	public function showForgotPassword(): Factory|View|Application
	{
		return view("auth.forgot-password");

	}
	public function showResetPassword(string $token): Factory|View|Application
	{
		return view('auth.reset-password', ['token' => $token]);
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

	public function forgotPassword(ForgotPasswordFormRequest $request): RedirectResponse
	{
		
		$status = Password::sendResetLink(
			$request->only('email')
		);

		// TODO 3rd lesson

		return $status === Password::RESET_LINK_SENT
			? back()->with(['message' => __($status)])
			: back()->withErrors(['email' => __($status)]);
	}


	public function resetPassword(ResetPasswordFormRequest $request): RedirectResponse
	{
		$status = Password::reset(
			$request->only('email', 'password', 'password_confirmation', 'token'),
			function (User $user, string $password) {
				$user->forceFill([
					'password' => bcrypt($password)
				])->setRememberToken(str()->random(60));

				$user->save();

				event(new PasswordReset($user));
			}
		);
		return $status === Password::PASSWORD_RESET
			? redirect()->route('login')->with('status', __($status))
			: back()->withErrors(['email' => [__($status)]]);
	}
}
