@extends('front.layouts.app')
@section('content')
    <div class="login-background">
        <a href="{{ route('home') }}">@svg('close')</a>
        <div class="login-form">
            <h1>Восстановление пароля</h1>
            <form action="{{ route('password.email') }}" method="POST">

                @csrf
                <input type="text"
                       name="email"
                       placeholder="email"
                       value="{{ old('email') }}"
                >

                @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <button type="submit" >Отправить</button>
            </form>
        </div>
    </div>
@endsection
