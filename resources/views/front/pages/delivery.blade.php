@extends('front.layouts.app')
@section('content')
    <div class="delivery-page container">
        @include('front.parts.breadcrumbs', ['pageName' => __('homepage.delivery')])
        <div class="delivery-page__block">
            <h1>Які умови доставки?</h1>
            <p>
                Доставка здійснюється з пʼятниці до вівторка включно.
                У середу та четвер ви можете зробити замовлення на пʼятницю та наступні дні.
                Рекомендуємо оформлювати замовлення якомога завчасно, оскільки щотижня ми отримуємо
                обмежену кількість квітів зі всього світу.
            </p>
            <p>
                Звертаємо вашу увагу, що ми не приймаємо замовлення із доставкою в той самий день після 14.00.
                Букети не передбачають відправку поштою, але ми відправляємо різдвяні вінки по всій Україні.
            </p>
            <p>
                Часовий проміжок доставки: з 11 до 18, також прислухаємось до ваших побажань.
                Звертаємо вашу увагу, що під час повітряних тривог можлива затримка доставки,
                проте ми залишаємось на зв’язку.
            </p>
        </div>
        <div class="delivery-page__block">
            <h1>Чи можна ділитися побажаннями щодо букета? Скільки букет буде стояти?</h1>
            <p>
                Наш сервіс спеціалізується на створенні унікальних флористичних композицій.
                Комбінація квітів у букеті залежить від сезону та нашого художнього бачення.
                При формуванні онлайн замовлення ви можете додати примітку / коментар щодо колірної гами,
                настрою та події. Ми комбінуємо багато різних рослин, гілок та квітів.
                Кожен компонент проходить свій цикл в композиції: квітне на початку, засихає,
                коли сусідня рослина тільки розквітає. Ці стадії є невіддільною частиною/ознакою наших робіт.
                Тому ми не можемо прогнозувати «тривалість» букету, але стараємось зробити його максимально стійким.
            </p>
        </div>
        <div class="delivery-page__block">
            <h1>Який радіус доставки?</h1>
            <p>
                Доставка здійснюється курʼєром в межах Києва. Вартість доставки включена у вартість букета.
                Букети не передбачають транспортування поштою.
            </p>
        </div>
    </div>
@endsection
