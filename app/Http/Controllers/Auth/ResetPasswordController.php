<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResetPasswordFormRequest;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Console\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Domain\Auth\Models\User;
use Illuminate\Support\Facades\Password;

class   ResetPasswordController extends Controller
{
    public function page(string $token): Factory|View|Application
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    public function handle(ResetPasswordFormRequest $request): RedirectResponse
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
            return redirect()->route('login');
        }

        return redirect()->route('login')->withErrors(['email' => [__($status)]]);
    }

}
