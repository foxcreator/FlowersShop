<div class="container">

    <nav class="custom-header @if (request()->route()->getName() !== 'home') white-theme @endif">
        <div class="custom-header__logo">
            <a href="{{ route('home') }}">@svg('logo-min')</a>
        </div>
        <div class="custom-header__pages">
            <ul>
                <li><a href="{{ route('front.catalog') }}">{{ __('homepage.catalog') }}</a></li>
                <li><a href="{{ route('front.delivery') }}">{{ __('homepage.delivery') }}</a></li>
                <li><a href="{{ route('front.about') }}">{{ __('homepage.about_us') }}</a></li>
                <li><a href="{{ route('front.contacts') }}">{{ __('homepage.contacts') }}</a></li>
            </ul>
        </div>
        <div class="custom-header__icons-menu">
            <ul class="items">
                <li class="custom-header__dropdown">
                    <a href="#" class="custom-header__dropdown-toggle">
                        @if(session('locale') === 'uk')
                            Укр
                        @else
                            рус
                        @endif
                        @svg('arrow-down')
                    </a>
                    <ul class="custom-header__dropdown-menu--lang">
                        <li class="custom-header__dropdown-item">
                            <a href="{{ route('locale', 'uk') }}">
                                Укр
                            </a>
                        </li>
                        <li class="custom-header__dropdown-item">
                            <a href="{{ route('locale', 'ru') }}">
                                рус
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="custom-header__dropdown">
                    <a href="#" class="custom-header__dropdown-toggle">
                        Днипро
                        @svg('arrow-down')
                    </a>
                    <ul class="custom-header__dropdown-menu">
                        <div class="custom-input">
                            @svg('search')
                            <input type="text" name="city_search">
                        </div>
                        <li class="custom-header__dropdown-item">Киев</li>
                        <li class="custom-header__dropdown-item">Львов</li>
                        <li class="custom-header__dropdown-item">Хмельницкий</li>
                    </ul>
                </li>
                <li>
                    <a class="search-toggle" href="">
                        @svg('search')
                    </a>
                </li>
                <li>
                    <a href="">
                        @svg('heart')
                    </a>
                </li>
                <li>
                    <a href="{{ route('front.cart') }}" class="position-relative">
                        @svg('cart')
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success cart-count">
                            {{ \Cart::session($_COOKIE['cart_id'])->getTotalQuantity() }}
                            <span class="visually-hidden">unread messages</span>
                        </span>
                    </a>
                </li>
                <li>
                    @auth()
                        <a href="{{ route('front.user.profile') }}">
                            @svg('user')
                        </a>
                    @else
                    <a href="{{ route('login') }}">
                        @svg('user')
                    </a>
                    @endauth
                </li>
            </ul>
        </div>
    </nav>
</div>
@include('components.search')

