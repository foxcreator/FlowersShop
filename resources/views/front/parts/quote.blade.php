@php
$subjects = \App\Models\Subject::all();
$flowers = \App\Models\Flower::all();
@endphp


<div class="quote">
    <h1>Квіти не вирішують усіх проблем.</h1>
    <h1>Але вони – хороший початок.</h1>
</div>

<div class="change-flower">
    <div class="container">
    <h1>{{ __('homepage.help_change_flower') }}</h1>
    <form action="{{ route('front.change.flower') }}" method="POST">
        @csrf
        <div class="change-flower__select-block row">
            {{--        Повод       --}}
            <div class="change-flower__select-wrapper col-lg-3 col-md-6">
                <select name="subject" id="reason">
                    @foreach($subjects as $subject)
                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                    @endforeach
                </select>
            </div>
            {{--        Для кого       --}}
            <div class="change-flower__select-wrapper col-lg-3 col-md-6">
                <select name="for_whom" id="for_whom">
                    <option value="">Для любимой</option>
                    <option value="">Для мамы</option>
                    <option value="">Для сестры</option>
                </select>
            </div>
            {{--        Повод       --}}
            <div class="change-flower__select-wrapper col-lg-3 col-md-6">
                <select name="flower" id="flower">
                    @foreach($flowers as $flower)
                        <option value="{{ $flower->id }}">{{ $flower->name }}</option>
                    @endforeach
                </select>
            </div>
            {{--        Повод       --}}
            <div class="change-flower__select-wrapper col-lg-3 col-md-6">
                <select name="max-price" id="budget">
                    <option value="500">до 500 грн</option>
                    <option value="1000">до 1000 грн</option>
                    <option value="2500">до 2500 грн</option>
                    <option value="5000">до 5000 грн</option>
                </select>
            </div>
            <div class="col-12">
                <button class="change-flower__btn">{{ __('homepage.change_bouquet') }}</button>
            </div>
        </div>
    </form>
    </div>
</div>

<div class="about">
    <h1>{{ __('homepage.about_us') }}</h1>
    <p><b><i>The Lotus</i></b> завжди готова запропонувати вам різноманітні варіанти доставки букетів квітів, розуміючи, що квіти завжди є ідеальним рішенням для кожного випадку.
        Тому ми створили кілька додаткових категорій доставки по Харкову, щоб ви могли порадувати своїх близьких і при цьому уникнути стандартних рішень.</p>
</div>

<div class="coffee">
    <h1>{{ __('homepage.coffee_shop') }}</h1>
    <p><b><i>The Lotus</i></b> завжди готова запропонувати вам різноманітні варіанти доставки букетів квітів, розуміючи, що квіти завжди є ідеальним рішенням для кожного випадку.
        Тому ми створили кілька додаткових категорій доставки по Харкову, щоб ви могли порадувати своїх близьких і при цьому уникнути стандартних рішень.</p>
</div>

<div class="questions">
    <h3>{{ __('homepage.any_questions') }}</h3>
    <h3>{{ __('homepage.leave_contacts') }}</h3>

    <form action="" class="questions__form">
        <input type="text" name="name" id="name" placeholder="{{ __('homepage.your_name') }}">
        <input type="text" name="phone" id="phone" placeholder="{{ __('homepage.your_phone') }}">
        <input type="text" name="question" id="question" placeholder="{{ __('homepage.your_question') }}">

        <button type="submit" class="questions__btn">{{ __('homepage.send') }}</button>
    </form>
</div>

<div class="contacts">
    <div class="contacts__info">
        <h1>{{ __('homepage.contacts') }}</h1>
        <p>+38 (063) 787 5888</p>
        <p>+38 (098) 220 0673</p>
        <p>+38 (063) 787 5888</p>
        <p>м. Київ, вул. Глибочицька 40г</p>
        <p>відчинено з 09:00 до 20:00 щодня</p>
        <div class="contacts__social">
            <a href="#">@svg('instagram')</a>
            <a href="#">@svg('facebook')</a>
            <a href="#">@svg('telegram')</a>
        </div>
    </div>
    <div class="contacts__map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d978.5342879053192!2d35.03462432637196!3d48.460711208622655!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1z0JHQpiDQkNGA0LXQvdCw!5e0!3m2!1sru!2sua!4v1713203733638!5m2!1sru!2sua" width="540" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
</div>
