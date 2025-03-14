<?php

namespace App\Http\Requests;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Tests\RequestFactories\SignUpRequestFactory;

class SignUpFormRequest extends FormRequest
{

    public static $factory = SignUpRequestFactory::class;

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize(): bool
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, mixed>
	 */
	public function rules(): array
	{

		return [
			'name' => ['required','string','min:1'],
			'email' => ['required', 'email:dns','unique:users'],
			'password' => ['required','confirmed',Password::defaults()]
		];
	}

    protected function prepareForValidation(): void {
        $this->merge([
            'email'=> str(request('email'))
                ->squish()
                ->lower()
                ->value()
        ]);

    }
}
