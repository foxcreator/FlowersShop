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
                            <input type="text" id="cityName" name="city_search">
                        </div>
                    </ul>
                </li>
                <li>
                    <a class="search-toggle" href="">
                        @svg('search')
                    </a>
                </li>
                <li>
                    <a href="{{ route('front.favorites') }}">
                        @svg('heart')
                    </a>
                </li>
                <li>
                    <a href="{{ route('front.cart') }}" class="position-relative">
                        @svg('cart')
                        @if(session('cart_id'))
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success cart-count">
                            {{ \Cart::session(session('cart_id'))->getTotalQuantity() }}
                            <span class="visually-hidden">unread messages</span>
                        </span>
                        @endif
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
<script>

    $(document).ready(function() {
        $('#cityName').on('input', function() {
            var searchValue = $(this).val().trim();
            if (searchValue.length > 0) {
                // Отправляем запрос к API для поиска городов
                $.ajax({
                    url: 'https://api.novaposhta.ua/v2.0/json/',
                    method: 'POST',
                    contentType: 'text/plain',
                    data: JSON.stringify({
                        apiKey: "[ВАШ КЛЮЧ]",
                        modelName: "Address",
                        calledMethod: "searchSettlements",
                        methodProperties: {
                            CityName: searchValue,
                            Limit: 5
                        }
                    }),
                    success: function(response) {
                        var addresses = response.data[0].Addresses;
                        $('.custom-header__dropdown-item').each(function() {
                            var cityName = $(this).text().trim();
                            var cityExists = addresses.some(function(address) {
                                return address.Present === cityName;
                            });
                            if (cityExists) {
                                $(this).show();
                            } else {
                                $(this).hide();
                            }
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    }
                });
            } else {
                $('.custom-header__dropdown-item').hide();
            }
        });
    });
</script>
