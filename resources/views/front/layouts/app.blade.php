<!doctype html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>The Lotus</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css"
    />    <link href="{{ asset('datepicker/air-datepicker.css') }}" rel="stylesheet">
    <script src="{{ asset('datepicker/air-datepicker.js') }}"></script>

    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/js/order.js'])
</head>
<body>
<div id="toast-success" class="toast-success"></div>
<div id="toast-error" class="toast-error"></div>

@if(str_contains(request()->getPathInfo(), 'purchase'))
    @include('front.layouts.cart-nav')
@else
    @include('front.layouts.nav')
@endif

@yield('content')
<footer class="footer">
    <div class="container">
        <div class="footer__logo">
            @svg('lotus-logo')
        </div>
        <div class="footer__info">
            <div class="footer__about">
                <h3>{{ __('homepage.about_company') }}</h3>
                <ul>
                    <li><a href="{{ route('front.about') }}">{{ __('homepage.about_us') }}</a></li>
                    <li><a href="{{ route('front.delivery') }}">{{ __('homepage.services') }}</a></li>
                    <li><a href="{{ route('front.contacts') }}">{{ __('homepage.contacts') }}</a></li>
                    <li><a href="{{ route('front.contacts') }}">{{ __('homepage.feedback') }}</a></li>
                    <li><a href="{{ route('front.about') }}">{{ __('homepage.privacy_policy') }}</a></li>
                </ul>
            </div>
            <div class="footer__catalog">
                <h3>{{ __('homepage.catalog') }}</h3>
                <ul>
                    @foreach(\App\Models\Category::all() as $category)
                        <li>
                            <a href="{{ route('front.catalog', ['category' => $category->id]) }}">{{ $category->title }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="footer__contacts">
                <h3>{{ __('homepage.contacts') }}</h3>
                <ul>
                    <li>+38 (063) 787 5888</li>
                    <li>+38 (098) 220 0673</li>
                    <li>+38 (063) 787 5888</li>
                    <li>м. Київ, вул. Глибочицька 40г</li>
                    <li>відчинено з 09:00 до 20:00 щодня</li>
                </ul>
            </div>
        </div>

        <div class="footer__social">
            <a href="#">@svg('instagram')</a>
            <a href="#">@svg('facebook')</a>
            <a href="#">@svg('telegram')</a>
        </div>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>

<script>
    function showToast(id, text) {
        var toast = document.getElementById(id);
        toast.innerHTML = text + ` @svg('alert-success')`;
        toast.classList.add('show-toast');
        setTimeout(function() {
            toast.classList.remove('show-toast');
        }, 10000);

        toast.addEventListener('click', function () {
            toast.classList.remove('show-toast');
        })
    }

    document.addEventListener('DOMContentLoaded', function () {
        function handleDropdownToggleClick(event) {
            event.preventDefault();
            var dropdown = event.target.closest('.custom-header__dropdown');
            if (dropdown) {
                dropdown.classList.toggle('open');
                event.stopPropagation();
            }
        }

        document.addEventListener('click', function (event) {
            if (event.target.classList.contains('custom-header__dropdown-toggle')) {
                handleDropdownToggleClick(event);
            } else {
                // Закрываем все dropdowns при клике вне dropdown
                var dropdowns = document.querySelectorAll('.custom-header__dropdown.open');
                dropdowns.forEach(function (dropdown) {
                    // dropdown.classList.remove('open');
                });
            }
        });
    });


    document.addEventListener('DOMContentLoaded', function () {
        var dropdownToggle = document.querySelector('.search-toggle');
        var dropdown = document.querySelector('.search');
        var close = document.querySelector('.close-icon');

        dropdownToggle.addEventListener('click', function (event) {
            event.preventDefault(); // Предотвращаем переход по ссылке
            dropdown.classList.toggle('open');
            document.body.classList.toggle('fix');
            event.stopPropagation(); // Остановить всплытие события, чтобы клик на кнопке не вызывал закрытие всех дропдаунов
        });

        // Обработчик события click на документе для закрытия всех дропдаунов при клике в любом месте страницы
        close.addEventListener('click', function (event) {
            dropdown.classList.remove('open');
            document.body.classList.remove('fix');
        });
    });
    //Initialize Select2 Elements
    $('.select2bs4').select2({
        theme: 'bootstrap4'
    })
</script>
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
<script src="{{ asset('main.js') }}"></script>

@if(session()->has('success'))
    <script>
        showToast('toast-success', '{{ session('success') }}')
    </script>
@elseif(session()->has('error'))
    <script>
        showToast('toast-error', '{{ session('error') }}')
    </script>
@endif
</body>
</html>
