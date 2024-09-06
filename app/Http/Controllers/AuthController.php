<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginFormRequest;
use App\Http\Requests\RegisterFormRequest;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin(){
		return view("auth.login");
	}
    public function showLoginMail(){
		return view("auth.login-mail");
	}
    public function showRegister(){
		return view("auth.register");
	}
    public function showRegisterMail(){
		return view("auth.register-mail");
	}


	public function login(LoginFormRequest $request){
		dd($request);
	}

	public function register(RegisterFormRequest $request) {

		$data = $request->all();

		$user = User::create($data);

		dd($user);

		
	}
}
