<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use DomainException;
use Illuminate\Http\RedirectResponse;
use Domain\Auth\Models\User;

use Laravel\Socialite\Facades\Socialite;
use Throwable;


class SocialAuthController extends Controller
{
    public function redirect(string $driver): RedirectResponse
    {
        try {
            return Socialite::driver($driver)->redirect();
        } catch (Throwable $e) {
            throw new DomainException('Произошла ошибка или драйвер не поддерживается');
        }
    }

    public function callback(string $driver): RedirectResponse
    {

        if($driver !== 'github') {
            throw new DomainException('Драйвер не поддерживается');
        }

        $githubUser = Socialite::driver($driver)->user();


        $user = User::query()->updateOrCreate([
            $driver . '_id' => $githubUser->id,
        ], [
            'name' => $githubUser->name ?? $githubUser->id,
            'password' => bcrypt(str()->random(12)),
            'email' => $githubUser->email,
        ]);

        auth()->login($user);

        return redirect()->intended(route('homePage'));
    }

}
