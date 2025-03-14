<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignInFormRequest extends FormRequest
{

    public static string $factory = \Tests\RequestFactories\SignInFormRequestFactory::class;

    public function authorize()
    {
        return auth()->guest();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
		// email:dns
        return [
			'email' => 'required|email|string',
			'password' => 'required|min:4',
        ];
    }
}
