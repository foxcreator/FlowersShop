<div class="container">

    <nav class="custom-header @if (request()->route()->getName() !== 'home') white-theme @endif">

        <div class="custom-header__desktop">

            <div class="desktop-inner">
                <div class="custom-header__pages">
                    <ul>
                        <li><a href="{{ route('front.catalog') }}" >{{ __('homepage.catalog') }}</a></li>
                        <li><a href="{{ route('front.delivery') }}">{{ __('homepage.delivery') }}</a></li>
                        <li><a href="{{ route('front.about') }}">{{ __('homepage.about_us') }}</a></li>
                        <li><a href="{{ route('front.contacts') }}">{{ __('homepage.contacts') }}</a></li>
                    </ul>
                </div>
                <div class="custom-header__logo">
                    <a href="{{ route('home') }}">@svg('logo-min')</a>
                </div>
                <div class="custom-header__icons-menu">
                <ul class="items">

                    <li class="custom-header__dropdown desktop">
                        <a href="#" class="custom-header__dropdown-toggle">
                            @if(session('locale') === 'uk' || auth()->user() && auth()->user()->lang === 'uk')
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
                    <li class="custom-header__dropdown desktop">
                        <a href="#" id="selectedCity" class="custom-header__dropdown-toggle">
                            @if(auth()->user() && auth()->user()->city)
                                {{ auth()->user()->city }}
                            @elseif(!auth()->user() && session('city') !== null)
                                {{ session('city') }}
                            @else
                                Дніпро
                            @endif
                            @svg('arrow-down')
                        </a>
                        <ul class="custom-header__dropdown-menu">
                            <div class="custom-input">
                                @svg('search')
                                <input type="text" id="cityName" name="city_search">
                            </div>
                            <li class="custom-header__dropdown-item"></li>
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
                                <span
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success cart-count">
                            {{ \Cart::session(session('cart_id'))->getTotalQuantity() }}
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
            </div>
            <ul class="items mobile">
                <li class="custom-header__dropdown mobile">
                    <a href="#" class="custom-header__dropdown-toggle">
                        @if(session('locale') === 'uk' || auth()->user() && auth()->user()->lang === 'uk')
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
                <li class="custom-header__dropdown mobile">
                    <a href="#" id="selectedCity" class="custom-header__dropdown-toggle selected-city">
                        @if(auth()->user() && auth()->user()->city)
                            {{ auth()->user()->city }}
                        @elseif(!auth()->user())
                            {{ session('city') }}
                        @else
                            Дніпро
                        @endif
                        @svg('arrow-down')
                    </a>
                    <ul class="custom-header__dropdown-menu">
                        <div class="custom-input">
                            @svg('search')
                            <input type="text" id="cityNameMobile" name="city_search">
                        </div>
                        <li class="custom-header__dropdown-item"></li>
                    </ul>
                </li>
            </ul>
        </div>

        <div class="custom-header__mobile">
            <div class="custom-header__logo">
                <a href="{{ route('home') }}">@svg('logo-min')</a>
            </div>
            <ul class="custom-header__burger-toggle">
                <li>
                    <button class="burger-toggle-btn">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                </li>
                <li>
                    <a class="search-toggle" href="">
                        @svg('search')
                    </a>
                </li>
                <li>
                    <a href="{{ route('front.cart') }}" class="position-relative">
                        @svg('cart')
                        @if(session('cart_id'))
                            <span
                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success cart-count">
                            {{ \Cart::session(session('cart_id'))->getTotalQuantity() }}
                        </span>
                        @endif
                    </a>
                </li>
            </ul>
            <!-- Блоки, которые будут скрыты при открытом бургер-меню -->
        </div>
    </nav>
</div>
<div class="custom-header__hidden-content">
    <div class="burger-content-header">
        <div id="close-burger" class="close-icon"></div>
    </div>
    <ul>
        <li><a href="{{ route('front.catalog') }}">{{ __('homepage.catalog') }}</a></li>
        <li><a href="{{ route('front.delivery') }}">{{ __('homepage.delivery') }}</a></li>
        <li><a href="{{ route('front.about') }}">{{ __('homepage.about_us') }}</a></li>
        <li><a href="{{ route('front.contacts') }}">{{ __('homepage.contacts') }}</a></li>
        <li>
            @auth()
                <a href="{{ route('front.user.profile') }}">
                    {{ __('profile.profile') }}
                </a>
            @else
                <a href="{{ route('login') }}">
                    {{ __('profile.profile') }}
                </a>
            @endauth
        </li>
        <li class="custom-header__dropdown">
            <a href="#" class="custom-header__dropdown-toggle">
                @if(session('locale') === 'uk' || auth()->user() && auth()->user()->lang === 'uk')
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
            <a href="#" id="selectedCity" class="custom-header__dropdown-toggle">
                @if(auth()->user() && auth()->user()->city)
                    {{ auth()->user()->city }}
                @elseif(!auth()->user())
                    {{ session('city') }}
                @else
                    Дніпро
                @endif
                @svg('arrow-down')
            </a>
            <ul class="custom-header__dropdown-menu">
                <div class="custom-input">
                    @svg('search')
                    <input type="text" id="cityNameBurger" name="city_search">
                </div>
                <li class="custom-header__dropdown-item"></li>
            </ul>
        </li>
    </ul>
</div>

@include('components.search')
<script>

    $(document).ready(function() {
        $('.custom-header__hidden-content').hide();


        $('.burger-toggle-btn').click(function(event) {
            event.preventDefault();
            $('.custom-header__hidden-content').show();
            $('body').toggleClass('fix');
            event.stopPropagation();
        });

        $('#close-burger').click(function(event) {
            $('.custom-header__hidden-content').hide();
            $('body').removeClass('fix');
        });

        $(document).click(function(event) {
            if (!$(event.target).closest('.custom-header__hidden-content').length) {
                $('.custom-header__hidden-content').hide();
                $('body').removeClass('fix');
            }
        });
    });


    $(document).ready(function () {

        $('#cityName').on('input', function () {
            console.log(123)
            var searchValue = $(this).val().trim();
            if (searchValue.length > 0) {
                searchCities(searchValue);
            } else {
                $('.custom-header__dropdown-item').remove();
            }
        });

        $('#cityNameMobile').on('input', function () {
            var searchValue = $(this).val().trim();
            if (searchValue.length > 0) {
                searchCities(searchValue);
            } else {
                $('.custom-header__dropdown-item').remove();
            }
        });

        $('#cityNameBurger').on('input', function () {
            console.log(123)

            var searchValue = $(this).val().trim();
            if (searchValue.length > 0) {
                searchCities(searchValue);
            } else {
                $('.custom-header__dropdown-item').remove();
            }
        });

        function searchCities(searchValue) {
            $.ajax({
                url: 'https://api.novaposhta.ua/v2.0/json/',
                method: 'POST',
                contentType: 'text/plain',
                data: JSON.stringify({
                    apiKey: "",
                    modelName: "Address",
                    calledMethod: "searchSettlements",
                    methodProperties: {
                        CityName: searchValue,
                        Limit: 5
                    }
                }),
                success: function (response) {
                    console.log(response);
                    var addresses = response.data[0].Addresses;
                    $('.custom-header__dropdown-item').remove();
                    addresses.forEach(function (address) {
                        var cityName = address.MainDescription;
                        var listItem = $('<li class="custom-header__dropdown-item"></li>').text(cityName);
                        listItem.on('click', function () {
                            $('.selected-city').text(cityName);
                            var dropdowns = document.querySelectorAll('.custom-header__dropdown.open');
                            dropdowns.forEach(function (dropdown) {
                                dropdown.classList.remove('open');
                            });
                            saveCityToSession(cityName, address.Ref);
                        });
                        $('.custom-header__dropdown-menu').append(listItem);
                    });

                },
                error: function (xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        }

        function saveCityToSession(cityName, cityRef) {
            $.ajax({
                url: '/save-city',
                method: 'POST',
                headers: {
                    'X-CSRF-Token': "{{ csrf_token() }}"
                },
                data: {
                    city: cityName,
                    ref: cityRef
                },
                success: function (response) {
                    window.location.reload()
                },
                error: function (xhr, status, error) {

                }
            });
        }
    });

</script>
