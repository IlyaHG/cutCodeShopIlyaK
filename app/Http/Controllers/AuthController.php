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
use Laravel\Socialite\Facades\Socialite;


class AuthController extends Controller
{
    public function showLogin(): Factory|View|Application|RedirectResponse
    {
        // flash()->info('test');


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
        

        $data = $request->except('_token', 'password_confirmation');

        $data['password'] = bcrypt($data['password']);

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

        if ($status === Password::RESET_LINK_SENT) {
            flash()->info(__($status));
            return back();
        }

        return back()->withErrors(['email' => __($status)]);
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

        if ($status === Password::PASSWORD_RESET) {
            flash()->info(__($status));
            return back();
        }

        return back()->withErrors(['email' => [__($status)]]);
    }

    public function github(): RedirectResponse
    {
        return Socialite::driver('github')->redirect();
    }

    public function githubCallBack()
    {
        $githubUser = Socialite::driver('github')->user();

        //TODO 3rd move to custom table

        $user = User::query()->updateOrCreate([
            'github_id' => $githubUser->id,
        ], [
            'name' => $githubUser->name ?? $githubUser->id,
            'password' => bcrypt(str()->random(12)),
            'email' => $githubUser->email,
        ]);

        auth()->login($user);

        return redirect()->intended(route('homePage'));
    }
}
