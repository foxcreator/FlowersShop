@extends('front.layouts.app')
@section('content')
    <div class="login-background">
        <a href="{{ route('home') }}">@svg('close')</a>
        <div class="success-form">
            <h1>Спасибо за заказ</h1>
            <a href="" class="default-btn ">Вернуться на сайт</a>
        </div>
    </div>
@endsection

