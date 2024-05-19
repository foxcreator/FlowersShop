@extends('front.layouts.app')
@section('content')
    <div class="contact-page container">
        @include('front.parts.breadcrumbs', ['pageName' => __('homepage.contacts')])
        <div class="contact-page__info-blocks row">
            <div class="contact-page__block col-lg-6">
                <div class="contact-page__phones">
                    <h2>{{ __('homepage.contacts') }}</h2>
                    <a href="tel:0939998877">+38 (063) 787 5888</a>
                    <a href="tel:0939998877">+38 (063) 787 5888</a>
                    <a href="tel:0939998877">+38 (063) 787 5888</a>
                    <p>{{ __('texts.address') }}</p>
                    <p>{{ __('texts.open_hours') }}</p>
                </div>
                <div class="contact-page__social">
                    <a href="#">@svg('instagram')</a>
                    <a href="#">@svg('facebook')</a>
                    <a href="#">@svg('telegram')</a>
                </div>
            </div>
            <form class="contact-page__block col-lg-6 col-md-9">
                <h2>{{ __('homepage.feedback') }}</h2>
                <input type="text" class="default-input" name="name" placeholder="{{ __('placeholders.name') }}">
                <input type="text" class="default-input" name="phone" placeholder="{{ __('placeholders.phone') }}">
                <input type="text" class="default-input" name="question"
                       placeholder="{{ __('placeholders.question') }}">
                <button type="submit" class="default-btn col-12">{{ __('homepage.send') }}</button>
            </form>
        </div>
        <div class="contact-page__map">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d978.5342879053192!2d35.03462432637196!3d48.460711208622655!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1z0JHQpiDQkNGA0LXQvdCw!5e0!3m2!1sru!2sua!4v1713203733638!5m2!1sru!2sua"
                width="100%" height="500"
                style="border:0;" allowfullscreen=""
                loading="lazy" referrerpolicy="no-referrer-when-downgrade"
            ></iframe>

        </div>
    </div>
@endsection
