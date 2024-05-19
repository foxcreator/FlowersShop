@extends('front.layouts.app')
@section('content')
    <div class="login-background">
        <a href="{{ route('home') }}">@svg('close')</a>
        <div class="login-form">
            <h1>{{ __('auth.register') }}</h1>
            <p>{{ __('auth.isset_account') }} <a class="link-black text-dark" href="{{ route('login') }}">{{ __('auth.auth_now') }}</a></p>
            <form action="{{ route('register.store') }}" method="POST">

                @csrf
                <input type="text"
                       name="phone"
                       placeholder="{{ __('auth.phone') }}"
                       value="{{ old('phone') }}"
                >
                @error('phone')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <input type="password"
                       name="password"
                       placeholder="{{ __('auth.password') }}"
                >
                @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <input type="password"
                       name="password_confirmation"
                       placeholder="{{ __('auth.confirm_password') }}"
                >
                <button type="submit" >{{ __('auth.registered') }}</button>
            </form>
        </div>
    </div>
@endsection
