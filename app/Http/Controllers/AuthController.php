<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginFormRequest;
use App\Http\Requests\RegisterFormRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
	public function showLogin()
	{
		return view("auth.login");
	}
	public function showLoginMail()
	{
		return view("auth.login-mail");
	}
	public function showRegister()
	{
		return view("auth.register");
	}
	public function showRegisterMail()
	{
		return view("auth.register-mail");
	}


	public function login(LoginFormRequest $request)
	{
		if (auth('web')->attempt($request->only('email', 'password'))) {
			return redirect('homePage');
		} 
		return redirect(route('showLoginMail'))->withErrors(['email'=> 'Пользователь не найден, либо данные введены не правильно']);
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
}
