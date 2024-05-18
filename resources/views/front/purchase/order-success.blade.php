@extends('front.layouts.app')
@section('content')
    <div class="login-background">
        <a href="{{ route('home') }}">@svg('close')</a>
        <div class="success-form">
            <h1>{{ __('order.thanks_for_order') }}</h1>
            <a href="{{ route('home') }}" class="default-btn ">{{ __('order.back_to_site') }}</a>
        </div>
    </div>
@endsection

