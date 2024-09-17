<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginFormRequest;
use App\Http\Requests\RegisterFormRequest;
use App\Http\Requests\ForgotPasswordFormRequest;
use Illuminate\Http\Request;
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

	public function login(LoginFormRequest $request)
	{
		if (auth('web')->attempt($request->only('email', 'password'))) {
			return redirect('homePage');
		}
		return redirect(route('showLoginMail'))->withErrors(['email' => 'Пользователь не найден, либо данные введены не правильно']);
	}

	public function register(RegisterFormRequest $request)
	{
		$data = $request->all();

		$data['password'] = Hash::make($data['password']);

		$user = User::create($data);

		if ($user) {
			auth('web')->login($user);
		}

		return redirect()->route('homePage');
	}
	public function logout()
	{
		auth('web')->logout();
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
