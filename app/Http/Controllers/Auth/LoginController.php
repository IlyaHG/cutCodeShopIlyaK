<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginFormRequest;
use Illuminate\Console\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;



class LoginController extends Controller
{
    public function page(): Factory|View|Application|RedirectResponse
    {
        // flash()->info('test');
        return view("auth.login");
    }

    public function handle(LoginFormRequest $request): RedirectResponse
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
    public function logout(): RedirectResponse
    {

        auth()->logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect(route('login'));

    }

}
