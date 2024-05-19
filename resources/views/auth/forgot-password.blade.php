@extends('front.layouts.app')
@section('content')
    <div class="login-background">
        <a href="{{ route('home') }}">@svg('close')</a>
        <div class="login-form">
            <h1 class="mb-5">{{ __('auth.recover_password') }}</h1>
            <form action="{{ route('password.email') }}" method="POST">
                @csrf
                <input type="text"
                       name="email"
                       placeholder="Email"
                       value="{{ old('email') }}"
                >

                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <button type="submit" >{{ __('auth.send') }}</button>
            </form>
        </div>
    </div>
@endsection
