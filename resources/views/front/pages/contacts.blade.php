@extends('front.layouts.app')
@section('content')
    <div class="contact-page container">
        @include('front.parts.breadcrumbs', ['pageName' => __('homepage.contacts')])
        <div class="contact-page__info-blocks">
        <div class="contact-page__block">
            <h2>Контакты</h2>
            <a href="tel:0939998877">+38 (063) 787 5888</a>
            <a href="tel:0939998877">+38 (063) 787 5888</a>
            <a href="tel:0939998877">+38 (063) 787 5888</a>
            <p>г. Днепр ул. Короленко 10а</p>
            <p>открыто с 09:00 до 19:00 каждый день</p>
            <div class="contact-page__social">
                <a href="#">@svg('instagram')</a>
                <a href="#">@svg('facebook')</a>
                <a href="#">@svg('telegram')</a>
            </div>
        </div>
        <form class="contact-page__block">
            <h2>Обратная связь</h2>
            <input type="text" class="default-input" name="name" placeholder="{{ __('placeholders.name') }}">
            <input type="text" class="default-input" name="phone" placeholder="{{ __('placeholders.phone') }}">
            <input type="text" class="default-input" name="question" placeholder="{{ __('placeholders.question') }}">
            <button type="submit" class="default-btn">Отправить</button>
        </form>
        </div>
        <div class="contact-page__map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d978.5342879053192!2d35.03462432637196!3d48.460711208622655!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1z0JHQpiDQkNGA0LXQvdCw!5e0!3m2!1sru!2sua!4v1713203733638!5m2!1sru!2sua"
                    width="100%" height="500"
                    style="border:0;" allowfullscreen=""
                    loading="lazy" referrerpolicy="no-referrer-when-downgrade"
            ></iframe>

        </div>
    </div>
@endsection
