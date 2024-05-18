@extends('front.layouts.app')
@section('content')
    <div class="login-background">
        <a href="{{ route('home') }}">@svg('close')</a>
        <div class="login-form">
            <h1>{{ __('auth.auth') }}</h1>
            <p>{{ __('auth.not_account') }} <a class="link-black text-dark" href="{{ route('register') }}">{{ __('auth.registered_account') }}</a></p>
            <form action="{{ route('login.store') }}" method="POST">

                @csrf
                <input type="text"
                       name="credential"
                       placeholder="{{ __('auth.phone') }}"
                       @if($errors->first('credential')) class="wrong" @endif
                       value="{{ old('credential') }}"
                >
                <input type="password"
                       name="password"
                       placeholder="{{ __('auth.password') }}"
                       @if($errors->first('credential')) class="wrong" @endif
                >
                <div>
                    <span class="text-danger w-50">{{ $errors->first('credential') }}</span>
                    <a class="forgot-password" href="{{ route('password.reset') }}"><span>{{ __('auth.forgot_password') }}</span></a>
                </div>
                <button type="submit" >{{ __('auth.login') }}</button>
            </form>
        </div>
    </div>
@endsection
