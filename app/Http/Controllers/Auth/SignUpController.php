<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\SignUpFormRequest;
use Domain\Auth\Contracts\RegisterNewUserContract;
use Illuminate\Console\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;



class SignUpController extends Controller
{
    public function page(): Factory|View|Application|RedirectResponse
    {
        // flash()->info('test');
        return view("auth.sign-up");
    }

    public function handle(SignUpFormRequest $request, RegisterNewUserContract $action): RedirectResponse
    {
        // TODO DTOs

        $data = $request->except('_token', 'password_confirmation');

        $action(
            $data['name'],
            $data['email'],
            $data['password']
        );

        return redirect()->route('home');
    }

}
