@extends('front.layouts.app')
@section('content')
    @php
    $userBalance = isset(auth()->user()->balance) ? auth()->user()->balance : 0;
    $defaultCity = '';
    if (auth()->user() && auth()->user()->city) {
        $defaultCity = auth()->user()->city;
    } elseif (session('city') !== null) {
        $defaultCity = session('city');
    }
    @endphp
    <div class="container">
        <h1>Оформление заказа</h1>
        <div class="order">
            <form action="{{ route('front.order.store') }}" method="POST" class="order__form">
                @csrf
                <div class="order__tabs">
                    @guest
                    <div class="tab current-tab" data-tab="new"><span>Новый покупатель</span></div>
                    <div class="tab" data-tab="regular"><span>Постоянный покупатель</span></div>
                    @endguest
                </div>
                <div class="tab-content show-tab" id="new">
                    <div class="order__user">
                        <div class="user-success">
                            <div class="d-flex justify-content-between align-content-start">
                                <div>
                                    <h4>1. Личные данные</h4>
                                    <p class="customer-info">Имя: <span class="customer-name"></span></p>
                                    <p class="customer-info"> Телефон: <span class="customer-phone"></span></p>
                                </div>
                                <button class="edit-btn" type="button">Редактировать</button>
                            </div>
                        </div>
                        <div class="order__order-form-group user-data">
                            <h4>1. Личные данные</h4>
                            <input class="default-input" type="text" name="customer_phone"
                                   value="{{ auth()->user()?->phone }}" placeholder="{{ __('placeholders.phone') }}">
                            <input class="default-input" type="text" name="customer_name"
                                   value="{{ auth()->user()?->full_name }}" placeholder="{{ __('placeholders.name') }}">
                            <input class="default-input" type="email" name="email" value="{{ auth()->user()?->email }}"
                                   placeholder="{{ __('placeholders.email') }}">
                            <div>
                                <input id="switch" class="custom-switch" type="checkbox" name="anonymously" value="1">
                                <label for="switch">Отправить анонимно</label>
                            </div>
                            <button class="default-btn submit-user" type="button">Подтвердить</button>
                        </div>
                    </div>
                </div>
                <div class="tab-content" id="regular">
                    <div class="order__user">
                        @guest()
                            <div class="order__order-form-group user-data">
                                <h4>1. Авторизация</h4>
                                <input class="default-input" type="text" name="credential"
                                       placeholder="Номер телефона или email">
                                <input class="default-input" type="password" name="password" placeholder="Пароль">

                                <button class="default-btn submit-login" type="button">Войти</button>
                            </div>
                        @endguest
                    </div>

                </div>
                <div class="order__delivery">
                    <div class="delivery-success">
                        <div class="d-flex justify-content-between align-content-start">
                            <div>
                                <h4>2. Доставка</h4>
                                <p class="customer-info">Доставка: <span class="delivery-address"></span></p>
                            </div>
                            <button class="edit-btn-delivery" type="button">Редактировать</button>
                        </div>
                    </div>
                    <h4 class="delivery-header">2. Доставка</h4>
                    <div class="order__order-form-group delivery-block">

                        <div class="d-flex">
                            <div class="delivery-tabs">
                                <div class="delivery-tab current-tab" id="delivery"><span>Доставка</span></div>
                                <div class="delivery-tab" id="self-delivery"><span>Самовывоз</span></div>
                            </div>
                        </div>
                        <div class="delivery" id="delivery-content">
                            <div class="input-block">
                            <input class="default-input" type="text" id="selectedCity" name="city"
                                   value="{{$defaultCity}}">
                                <ul id="cities_menu" class="delivery-dropdown-menu"></ul>
                            </div>
                            <div class="input-block">
                                <input class="default-input" type="text" name="street" id="selectedStreet" placeholder="{{ __('placeholders.street') }}">
                                <ul id="streets_menu" class="delivery-dropdown-menu"></ul>
                            </div>
                            <div class="input-block">
                                <input class="default-input input-min" type="text" name="house" placeholder="{{ __('placeholders.house') }}">
                                <input class="default-input input-min" type="text" name="flat" placeholder="{{ __('placeholders.flat') }}">
                            </div>
                            <div class="input-block">
                                <input id="datepicker" class="default-input input-min" type="text" name="date" placeholder="{{ __('placeholders.date') }}">
                                <select class="choices input-min" name="time" id="time">
                                    <option value="9:00 - 12:00">9:00 - 12:00</option>
                                    <option value="12:00 - 15:00">12:00 - 15:00</option>
                                    <option value="15:00 - 18:00">15:00 - 18:00</option>
                                    <option value="18:00 - 21:00">18:00 - 21:00</option>
                                </select>
                            </div>
                            <input type="hidden" id="delivery_option" name="delivery_option" value="courier">
                        </div>
                        <div class="recipient-tabs">
                            <p class="recipient-tab current-tab" id="recipient">В подарок</p>
                            <p class="recipient-tab" id="customer">Я получатель</p>
                        </div>
                        <div class="recipient">
                            <input class="default-input" type="text" name="name" placeholder="{{ __('placeholders.recipient_name') }}">
                            <input class="default-input" type="text" name="phone" placeholder="{{ __('placeholders.phone') }}">
                        </div>

                        <button class="default-btn submit-delivery" type="button">Подтвердить</button>
                    </div>
                </div>
                <div class="order__gifts">
                    <div class="gifts-success">
                        <div class="d-flex justify-content-between align-content-start">
                            <div>
                                <h4>3. Открытка и подарки</h4>

                                <p class="customer-info">Текст открытки: <span class="text-postcard"></span></p>
                            </div>
                            <button class="edit-btn-gifts" type="button">Редактировать</button>
                        </div>
                    </div>

                    <h4 class="gifts-header">3. Открытка и подарки</h4>
                    <div class="add-products">
                        <div class="gift">
                            <div id="giftCarousel" class="carousel slide carousel-fade">
                                <div class="carousel-inner">
                                    @php $products = \App\Models\Product::all(); @endphp
                                    @for($i = 0; $i < count($products); $i += 2)
                                        <div class="carousel-item {{ $i === 0 ? 'active' : '' }}">
                                            <div class="row">
                                                @foreach($products->slice($i, 2) as $product)
                                                    <div class="col-md-6 position-relative">
                                                        <img style="width: 200px; height: 200px"
                                                             src="{{ $product->thumbnailUrl }}"
                                                             class="d-block w-100 product-img"
                                                             alt="{{ $product->title }}"
                                                             data-product-id="{{ $product->id }}"
                                                        >
                                                        <div class="card-info">
                                                            <p>{{ $product->title }}</p>
                                                            <p>₴ {{ (int) $product->price }}</p>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endfor
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#giftCarousel"
                                        data-bs-slide="prev">
                                    @svg('carousel-prev')
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#giftCarousel"
                                        data-bs-slide="next">
                                    @svg('carousel-next')
                                </button>
                            </div>
                        </div>
                        <div class="postcard">
                            <div id="postcardCarousel" class="carousel slide carousel-fade">
                                <div class="carousel-inner">
                                    @php $products = \App\Models\Product::all(); @endphp
                                    @for($i = 0; $i < count($products); $i += 2)
                                        <div class="carousel-item {{ $i === 0 ? 'active' : '' }}">
                                            <div class="row">
                                                @foreach($products->slice($i, 2) as $product)
                                                    <div class="col-md-6 position-relative">
                                                        <img style="width: 200px; height: 200px"
                                                             src="{{ $product->thumbnailUrl }}"
                                                             class="d-block w-100 product-img"
                                                             data-product-id="{{ $product->id }}"
                                                             alt="{{ $product->title }}">
                                                        <div class="card-info">
                                                            <p>{{ $product->title }}</p>
                                                            <p>₴ {{ (int) $product->price }}</p>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endfor
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#postcardCarousel"
                                        data-bs-slide="prev">
                                    @svg('carousel-prev')
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#postcardCarousel"
                                        data-bs-slide="next">
                                    @svg('carousel-next')
                                </button>
                            </div>

                            <input class="default-input" type="text" name="text_postcard" placeholder="{{ __('placeholders.text_postcard') }}">
                            <button class="default-btn submit-gifts" type="button">Подтвердить</button>

                        </div>
                    </div>
                </div>
                <div class="order__pay">
                    <div class="pay-success">
                        <h4>4. Оплата</h4>
                    </div>
                    <div class="pay-block">
                        <h4>4. Оплата</h4>
                        <div class="payment">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_method" value="bank"
                                       id="bank" checked>
                                <label class="form-check-label" for="bank">
                                    Fondy
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_method" value="cash"
                                       id="cash" checked>
                                <label class="form-check-label" for="cash">
                                    При получении
                                </label>
                            </div>
                        </div>
                        @auth
                        <div class="bonus">
                            <input class="default-input" type="text" name="bonus" id="bonus" placeholder="Введите сумму">
                            <a id="pay-bonus" href="#">Оплатить балами</a>
                        </div>
                        @endauth
                        <div class="comment">
                            <p id="comment-text">+ Добавить комментарий к заказу</p>
                        </div>
                        <div>
                            <input id="switch-call" class="custom-switch" type="checkbox" name="call" value="1">
                            <label for="switch-call">Не звонить для подтверждения</label>
                        </div>
                        @auth
                        <input type="hidden" name="user_id" value="{{ auth()->user()->getAuthIdentifier() }}">
                        @endauth
                        <button type="submit" class="default-btn">Оформить заказ</button>
                    </div>
                </div>
            </form>
            <div class="order__sum">
                @include('front.purchase.parts.order-cart')
            </div>
        </div>
    </div>

    <script>

        new AirDatepicker('#datepicker', {
            autoClose: false
        });


        var currentCityRef; // Переменная для хранения текущего города
        var currentStreetRef; // Переменная для хранения текущей улицы

        $(document).ready(function() {
            $('#cities_menu').hide();
            $('#streets_menu').hide();

            $('#selectedCity').on('input', function() {
                var searchValue = $(this).val().trim();
                if (searchValue.length > 0) {
                    fetchCities(searchValue);
                } else {
                    $('.delivery-dropdown-item').remove();
                }
            });

            $('#selectedStreet').on('input', function() {
                var searchValue = $(this).val().trim();
                if (searchValue.length > 0) {
                    fetchStreets(searchValue);
                } else {
                    $('.delivery-dropdown-item').remove();
                }
            });

            // Функция для запроса городов
            function fetchCities(searchValue) {
                $('.delivery-dropdown-item').remove();

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
                    success: function(response) {
                        renderItems(response.data[0].Addresses, '#cities', '#cities_menu');
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    }
                });
            }

            // Функция для запроса улиц
            function fetchStreets(searchValue) {
                $('.delivery-dropdown-item').remove();

                console.log(currentCityRef);
                $.ajax({
                    url: 'https://api.novaposhta.ua/v2.0/json/',
                    method: 'POST',
                    contentType: 'text/plain',
                    data: JSON.stringify({
                        apiKey: "",
                        modelName: "Address",
                        calledMethod: "searchSettlementStreets",
                        methodProperties: {
                            StreetName: searchValue,
                            SettlementRef: currentCityRef,
                            Limit: "5"
                        }
                    }),
                    success: function(response) {
                        renderItems(response.data[0].Addresses, '#streets', '#streets_menu');
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    }
                });
            }

            function renderItems(addresses, blockId, menuId) {
                $(blockId+'_item').remove();
                $(menuId).show();
                addresses.forEach(function(address) {
                    var itemName;
                    if (blockId === '#cities') {
                        itemName = address.MainDescription;
                    } else if (blockId === '#streets') {
                        itemName = address.Present;
                    }
                    var listItem = $('<li class="delivery-dropdown-item"></li>').text(itemName);
                    listItem.on('click', function() {
                        if (blockId === '#cities') {
                            $('#selectedCity').val(itemName);
                            currentCityRef = address.Ref;
                        } else if (blockId === '#streets') {
                            $('#selectedStreet').val(itemName);
                            currentStreetRef = address.Ref;
                        }
                        $(blockId+'_item').remove();
                        $(menuId).hide();
                    });
                    $('.delivery-dropdown-menu').append(listItem);
                });
            }

        });


        $('.product-img').on('click', function () {
            var productId = $(this).data('product-id');
            var $currentImg = $(this);

            $.ajax({
                url: '{{ route('front.addToCart') }}',
                type: 'POST',
                headers: {
                    'X-CSRF-Token': "{{ csrf_token() }}"
                },
                data: {id: productId, quantity: 1},
                success: function (response) {
                    var $newImg = $('<img>')
                        .attr('src', '{{ asset('front/images/ok.png') }}')
                        .addClass('d-block add-product-img')
                        .attr('data-product-id', response.productId)
                    $currentImg.before($newImg);
                    $('.order__sum').html(response.html)
                },
                error: function (xhr) {
                    console.error(xhr.responseText);
                }
            });
        });

        $(document).ready(function () {
            $('.submit-login').click(function () {
                var credential = $('input[name="credential"]').val();
                var password = $('input[name="password"]').val();

                $.ajax({
                    url: "{{ route('login.store') }}",
                    type: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-Token': "{{ csrf_token() }}"
                    },
                    data: {
                        credential: credential,
                        password: password
                    },
                    success: function (response) {
                        if (response.login === true) {
                            window.location.reload();
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                        alert('Произошла ошибка при авторизации. Пожалуйста, попробуйте еще раз.');
                    }
                });
            });

            $('#bonus').on('input', function() {
                var max = "{{ $userBalance }}";
                if (parseInt($(this).val()) > max) {
                    $(this).val(parseInt(max));
                }
            });

            $('#pay-bonus').click(function(event) {
                event.preventDefault();

                var bonusValue = $('#bonus').val();
                var total = $('#total').text();
                console.log(total);

                $.ajax({
                    url: '{{ route('front.order.bonus') }}',
                    method: 'POST',
                    headers: {
                        'X-CSRF-Token': "{{ csrf_token() }}"
                    },
                    data: { bonus: bonusValue },
                    success: function(response) {
                        if (response.status === 200) {
                            $('#total').text(total - bonusValue)
                            $('#bonus').prop('readonly', true);
                            $('#pay-bonus').removeAttr('href').css('cursor', 'default').addClass('no-active');
                            showToast('toast-success', 'Бонус применен');
                        }
                    },
                    error: function(xhr, status, error) {
                        if (xhr.status === 422) {
                            showToast('toast-error', xhr.responseJSON.message);
                        }
                    }
                });
            });
        });
    </script>
@endsection
