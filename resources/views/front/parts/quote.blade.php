@php
$subjects = \App\Models\Subject::all();
$flowers = \App\Models\Flower::all();
$subcategories = \App\Models\Subcategory::where('category_id', 1)->get();
@endphp


{{--<div class="quote">--}}
{{--    <div class="container">--}}
{{--    {!! __('texts.flowers_beautiful_start') !!}--}}
{{--    </div>--}}
{{--</div>--}}

{{--<div class="change-flower">--}}
{{--    <div class="container">--}}
{{--    <h1>{{ __('homepage.help_change_flower') }}</h1>--}}
{{--    <form action="{{ route('front.change.flower') }}" method="POST">--}}
{{--        @csrf--}}
{{--        <div class="change-flower__select-block row">--}}
{{--            --}}{{--        Повод       --}}
{{--            <div class="change-flower__select-wrapper col-lg-3 col-md-6">--}}
{{--                <select name="subject" id="reason">--}}
{{--                    @foreach($subjects as $subject)--}}
{{--                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>--}}
{{--                    @endforeach--}}
{{--                </select>--}}
{{--            </div>--}}
{{--            --}}{{--        Для кого       --}}
{{--            <div class="change-flower__select-wrapper col-lg-3 col-md-6">--}}
{{--                <select name="for_whom" id="for_whom">--}}
{{--                    @foreach($subcategories as $subcategory)--}}
{{--                        <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>--}}
{{--                    @endforeach--}}
{{--                </select>--}}
{{--            </div>--}}
{{--            --}}{{--        Повод       --}}
{{--            <div class="change-flower__select-wrapper col-lg-3 col-md-6">--}}
{{--                <select name="flower" id="flower">--}}
{{--                    @foreach($flowers as $flower)--}}
{{--                        <option value="{{ $flower->id }}">{{ $flower->name }}</option>--}}
{{--                    @endforeach--}}
{{--                </select>--}}
{{--            </div>--}}
{{--            --}}{{--        Повод       --}}
{{--            <div class="change-flower__select-wrapper col-lg-3 col-md-6">--}}
{{--                <select name="max-price" id="budget">--}}
{{--                    <option value="500">до 500 грн</option>--}}
{{--                    <option value="1000">до 1000 грн</option>--}}
{{--                    <option value="2500">до 2500 грн</option>--}}
{{--                    <option value="50000">від 5000 грн</option>--}}
{{--                </select>--}}
{{--            </div>--}}
{{--            <div class="col-12 col-md-6">--}}
{{--                <button class="change-flower__btn">{{ __('homepage.change_bouquet') }}</button>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </form>--}}
{{--    </div>--}}
{{--</div>--}}

{{--<div class="about">--}}
{{--    <div class="container">--}}
{{--    <h1>{{ __('homepage.about_us') }}</h1>--}}
{{--    <p>--}}
{{--        {{ __('texts.about_us') }}--}}
{{--    </p>--}}
{{--    </div>--}}
{{--</div>--}}

{{--<div class="coffee">--}}
{{--    <h1>{{ __('homepage.coffee_shop') }}</h1>--}}
{{--    <p>--}}
{{--        {{ __('texts.our_coffee_shop') }}--}}
{{--    </p>--}}
{{--</div>--}}

{{--<div class="questions">--}}
{{--    <div class="container">--}}
{{--    <h3>{{ __('homepage.any_questions') }}</h3>--}}
{{--    <h3>{{ __('homepage.leave_contacts') }}</h3>--}}

{{--    <form action="{{ route('front.feedback') }}" method="POST" class="questions__form">--}}
{{--        @csrf--}}
{{--        <input type="text" name="name" id="name" placeholder="{{ __('homepage.your_name') }}">--}}
{{--        <input type="text" name="phone" id="phone" placeholder="{{ __('homepage.your_phone') }}">--}}
{{--        <input type="text" name="question" id="question" placeholder="{{ __('homepage.your_question') }}">--}}

{{--        <button type="submit" class="questions__btn">{{ __('homepage.send') }}</button>--}}
{{--    </form>--}}
{{--    </div>--}}
{{--</div>--}}

<div class="contacts">
    <div class="contacts__info">
        <h1>{{ __('homepage.contacts') }}</h1>
        <p>+38 067 977 60 75</p>
        <p>+38 073 216 34 09</p>
        <p>{{ __('texts.address') }}</p>
        <p>пн-нд 8:00 – 21:00</p>
        <p>Без вихідних</p>
        <div class="contacts__social">
            <a href="https://www.instagram.com/bright_flowers_dnipro/" target="_blank">@svg('instagram')</a>
            <a href="https://www.facebook.com/profile.php?id=61560592424284" target="_blank">@svg('facebook')</a>
            <a href="https://t.me/brightflowers_dnipro" target="_blank">@svg('telegram')</a>
        </div>
    </div>
    <div class="contacts__map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d555.8679172944234!2d35.06633116092968!3d48.46236226971332!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40dbe30366a61123%3A0x727bf3cebeea6580!2z0LzQsNCz0LDQt9C40L0g0YbQstC10YLQvtCyINC4INC00LXQutC-0YDQsCBCUklHSFQgRkxPV0VSUw!5e0!3m2!1sru!2sua!4v1734872574680!5m2!1sru!2sua"
                width="100%"
                style="border:0;" allowfullscreen=""
                loading="lazy" referrerpolicy="no-referrer-when-downgrade"
        ></iframe>
    </div>
</div>
