@extends('layout.unauth-layout')
@section('title', 'Забыли пароль')
@section('content')

    <x-forms.auth-forms
	title="Забыли пароль"
	action="{{route('password-forgot.handle')}}"
	method="POST">

        <x-forms.text-input name="email" required="true" placeholder="Email" :isError="$errors->has('email')" value="{{old('email')}}" />


			@error('email')
            <x-forms.error>
                {{ $message }}
            </x-forms.error>
        @enderror

        <x-forms.primary-button> Отправить </x-forms.primary-button>

        <x-slot:socialAuth>
        </x-slot:socialAuth>

        <x-slot:buttons>
            <div class="space-y-3 mt-5">
				<div class="text-xxs md:text-xs"><a href="{{ route('login') }}"
					class="text-white hover:text-white/70 font-bold">Вспомнил пароль</a></div>
                <div class="text-xxs md:text-xs"><a href="{{ route('register') }}"
                        class="text-white hover:text-white/70 font-bold">Регистрация</a></div>
            </div>
        </x-slot:buttons>
    </x-forms.auth-forms>
@endsection
