@extends('front.layouts.app')
@section('content')
<div class="about-page container">
    @include('front.parts.breadcrumbs', ['pageName' => __('homepage.about_us')])
    <div class="about-page__block row">
        <div class="col-md-6 about-page__text-block">
            <h1>Про нас</h1>
            <p>
                Систематичне поліпшення, оригінальні технології, розширення технічної бази
                та робітнича майстерність забезпечили організації успіх і провідну роль на
                ринку України.
            </p>
            <p>
                Завдяки технологічним та надійним продуктам та послугам,
                талановитим співробітникам і серйозному ставленню до новаторства та інновацій,
                а також кооперації з клієнтами та рейтинговими агентствами,
                підприємство відкриває перед світом нові сучасні перспективи.
            </p>
        </div>
        <div class="col-md-6">
            <img src="{{ asset('dist/img/boxed-bg.jpg') }}" alt="">
        </div>
    </div>
    <div class="about-page__block row">
        <div class="col-md-6">
            <img src="{{ asset('dist/img/boxed-bg.jpg') }}" alt="">
        </div>
        <div class="col-md-6 about-page__text-block">
            <h1>Кавʼярня</h1>
            <p>
                Систематичне поліпшення, оригінальні технології, розширення технічної бази
                та робітнича майстерність забезпечили організації успіх і провідну роль на
                ринку України.
            </p>
            <p>
                Завдяки технологічним та надійним продуктам та послугам,
                талановитим співробітникам і серйозному ставленню до новаторства та інновацій,
                а також кооперації з клієнтами та рейтинговими агентствами,
                підприємство відкриває перед світом нові сучасні перспективи.
            </p>
        </div>
    </div>
</div>
@endsection
