@extends('front.layouts.app')
@section('content')
    <div class="login-background">
        <a href="{{ route('home') }}">@svg('close')</a>
        <div class="login-form">
            <h1>Регистрация</h1>
            <p>Уже есть аккаунт? <a class="link-black text-dark" href="{{ route('login') }}">Авторизуйся</a></p>
            <form action="{{ route('register.store') }}" method="POST">

                @csrf
                <input type="text"
                       name="phone"
                       placeholder="{{ __('placeholders.phone') }}"
                       value="{{ old('phone') }}"
                >
                @error('phone')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <input type="password"
                       name="password"
                       placeholder="{{ __('placeholders.login_password') }}"
                >
                @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <input type="password"
                       name="password_confirmation"
                       placeholder="{{ __('placeholders.password_confirmation') }}"
                >
                <button type="submit" >Войти</button>
            </form>
        </div>
    </div>
@endsection
