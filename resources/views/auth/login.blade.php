@extends('front.layouts.app')
@section('content')
    <div class="login-background">
        <a href="{{ route('home') }}">@svg('close')</a>
        <div class="login-form">
            <h1>Авторизация</h1>
            <p>Еще нет аккаунта? <a class="link-black text-dark" href="{{ route('register') }}">Зарегестрируйся</a></p>
            <form action="{{ route('login.store') }}" method="POST">

                @csrf
                <input type="text"
                       name="credential"
                       placeholder="{{ __('placeholders.phone') }}"
                       @if($errors->first('credential')) class="wrong" @endif
                       value="{{ old('credential') }}"
                >
                <input type="password"
                       name="password"
                       placeholder="{{ __('placeholders.login_password') }}"
                       @if($errors->first('credential')) class="wrong" @endif
                >
                <div>
                    <span class="text-danger w-50">{{ $errors->first('credential') }}</span>
                    <a class="forgot-password" href="{{ route('password.reset') }}"><span>Забыли пароль?</span></a>
                </div>
                <button type="submit" >Войти</button>
            </form>
        </div>
    </div>
@endsection
