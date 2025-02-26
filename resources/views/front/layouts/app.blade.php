<!doctype html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>BRIGHT FLOWERS</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css"
    />
    <link rel="icon" href="{{ asset('front/logo.png') }}" type="image/png">
    <link href="{{ asset('datepicker/air-datepicker.css') }}" rel="stylesheet">
    <script src="{{ asset('datepicker/air-datepicker.js') }}"></script>

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-NQ7K6ZFFDL"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-NQ7K6ZFFDL');
    </script>


    <script>
        gtag('event', 'page_view', {
            'page_title' : document.title,
            'page_path': window.location.pathname
        });
    </script>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
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
            <img class="logo" src="{{ asset('front/images/logo.png') }}" alt="brightflowers">
        </div>
        <div class="footer__info row">
            <div class="footer__about col-lg-3 col-md-6">
                <h3>{{ __('homepage.about_company') }}</h3>
                <ul>
                    <li><a href="{{ route('front.about') }}">{{ __('homepage.about_us') }}</a></li>
                    <li><a href="{{ route('front.contacts') }}">{{ __('homepage.contacts') }}</a></li>
                </ul>
            </div>
            <div class="footer__catalog col-lg-3 col-md-6">
                <h3>{{ __('homepage.catalog') }}</h3>
                <ul>
                    @foreach(\App\Models\Category::all() as $category)
                        <li>
                            <a href="{{ route('front.catalog', ['category' => $category->id]) }}">{{ $category->title }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="footer__contacts col-lg-4 col-md-6">
                <h3>{{ __('homepage.contacts') }}</h3>
                <ul>
                    <li><a href="{{ route('front.delivery') }}">{{ __('homepage.delivery') }}</a></li>
                    <li><a href="{{ route('front.payment') }}">{{ __('homepage.payment') }}</a></li>
                    <li><a href="{{ route('front.contacts') }}">{{ __('homepage.feedback') }}</a></li>
                    <li><a download="Policy"  href="{{ asset('policy.pdf') }}">{{ __('homepage.privacy_policy') }}</a></li>
                    <li><a download="Offer" href="{{ asset('public-contract.pdf') }}">{{ __('homepage.offer') }}</a></li>
                </ul>
            </div>

            <div class="footer__social col-lg-12 col-md-6">
                <a href="https://www.instagram.com/bright_flowers_dnipro/" target="_blank">@svg('instagram')</a>
                <a href="https://www.facebook.com/profile.php?id=61560592424284" target="_blank">@svg('facebook')</a>
                <a href="https://t.me/brightflowers_dnipro" target="_blank">@svg('telegram')</a>
            </div>
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

    $(document).ready(function() {
        $('.search-toggle').click(function(event) {
            event.preventDefault();
            $('.search').toggleClass('open');
            $('body').toggleClass('fix');
            event.stopPropagation();
        });

        $('.close-icon').click(function(event) {
            $('.search').removeClass('open');
            $('body').removeClass('fix');
        });

        $(document).click(function(event) {
            if (!$(event.target).closest('.search').length) {
                $('.search').removeClass('open');
                $('body').removeClass('fix');
            }
        });
    });

    $(document).ready(function() {
        var currentPath = window.location.pathname;

        if (currentPath === '/login' || currentPath === '/register' || currentPath === '/reset-password') {
            $('body').addClass('fix');
        }
    });

    //Initialize Select2 Elements
    $('.select2bs4').select2({
        theme: 'bootstrap4'
    })
</script>
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
<script src="{{ asset('main.js') }}"></script>
@vite(['resources/js/catalog.js', 'resources/js/order.js'])

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
