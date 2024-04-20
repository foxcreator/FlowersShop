<div class="container">
    <nav class="custom-header @if (request()->route()->getName() !== 'home') white-theme @endif">
        <div class="custom-header__logo">
            <a href="{{ route('home') }}">@svg('logo-min')</a>
        </div>
        <div class="custom-header__pages">
            <ul>
                <li><a href="{{ route('front.catalog') }}">Каталог</a></li>
                <li><a href="{{ route('front.delivery') }}">Доставка</a></li>
                <li><a href="{{ route('front.about') }}">Про нас</a></li>
                <li><a href="{{ route('front.contacts') }}">Контакти</a></li>
            </ul>
        </div>
        <div class="custom-header__icons-menu">
            <ul class="items">
                <li class="custom-header__dropdown">
                    <a href="#" class="custom-header__dropdown-toggle">
                        Укр
                        @svg('arrow-down')
                    </a>
                    <ul class="custom-header__dropdown-menu--lang">
                        <li class="custom-header__dropdown-item">Укр</li>
                        <li class="custom-header__dropdown-item">рус</li>
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
                    <a href="">
                        @svg('cart')
                    </a>
                </li>
                <li>
                    <a href="">
                        @svg('user')
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</div>
@include('components.search')

