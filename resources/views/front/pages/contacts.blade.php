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
                        пн-нд 10:00 – 19:00 <br>
                        Без вихідних
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
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2806.501751754408!2d35.04610432045896!3d48.457945177530036!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40dbe30366a61123%3A0x727bf3cebeea6580!2z0LzQsNCz0LDQt9C40L0g0LrQstGW0YLRltCyINGC0LAg0LTQtdC60L7RgNGDIFRoZUxvdHVzIGJvdXRpcXVl!5e0!3m2!1sru!2sua!4v1721643895218!5m2!1sru!2sua"
                    width="100%" height="500"
                    style="border:0;" allowfullscreen=""
                    loading="lazy" referrerpolicy="no-referrer-when-downgrade"
            ></iframe>
        </div>
    </div>
@endsection
