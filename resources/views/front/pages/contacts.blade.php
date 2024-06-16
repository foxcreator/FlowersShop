@extends('front.layouts.app')
@section('content')
    <div class="contact-page container">
        @include('front.parts.breadcrumbs', ['pageName' => __('homepage.contacts')])
        <div class="contact-page__info-blocks row">
            <div class="contact-page__block col-lg-6">
                <div class="contact-page__phones">
                    <h2>{{ __('homepage.contacts') }}</h2>
                    <a href="tel:0679776075">+38 067 977 60 75</a>
                    <a href="tel:0732163409">+38 073 216 34 09</a>
                    <p>{{ __('texts.address') }}</p>
                    <p>
                        {{ __('texts.open_hours') }} <br>
                        пн-пт 8:30 – 20:00 <br>
                        сб-нд 9:00 – 20:00
                    </p>
                </div>
                <div class="contact-page__social">
                    <a href="https://www.instagram.com/thelotusfb/" target="_blank">@svg('instagram')</a>
                    <a href="https://www.facebook.com/profile.php?id=61560592424284" target="_blank">@svg('facebook')</a>
                    <a href="https://t.me/thelts_flowers" target="_blank">@svg('telegram')</a>
                </div>
            </div>
            <form action="{{ route('front.feedback') }}" method="POST" class="contact-page__block col-lg-6 col-md-9">
                @csrf
                <h2>{{ __('homepage.feedback') }}</h2>
                <input type="text"
                       class="default-input"
                       name="name"
                       placeholder="{{ __('placeholders.name') }}"
                       value="{{ old('name') }}"
                >
                <input type="text"
                       class="default-input"
                       name="phone"
                       placeholder="{{ __('placeholders.phone') }}"
                       value="{{ old('phone') }}"
                >
                <input type="text"
                       class="default-input"
                       name="question"
                       placeholder="{{ __('placeholders.question') }}"
                       value="{{ old('question') }}"
                >
                <button type="submit" class="default-btn col-12">{{ __('homepage.send') }}</button>
            </form>
        </div>
        <div class="contact-page__map">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2645.930566996194!2d35.04832811248104!3d48.45786172868895!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40dbe2d916d55317%3A0xf916d0420635a754!2z0L_QtdGALiDQqNC10LLRh9C10L3QutC-LCA5LCDQlNC90LXQv9GALCDQlNC90LXQv9GA0L7Qv9C10YLRgNC-0LLRgdC60LDRjyDQvtCx0LvQsNGB0YLRjCwgNDkwMDA!5e0!3m2!1sru!2sua!4v1718526505036!5m2!1sru!2sua"
                width="100%" height="500"
                style="border:0;" allowfullscreen=""
                loading="lazy" referrerpolicy="no-referrer-when-downgrade"
            ></iframe>
        </div>
    </div>
@endsection
