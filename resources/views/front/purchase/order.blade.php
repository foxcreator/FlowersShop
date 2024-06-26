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

    $cityRef = '';
    if (auth()->user() && auth()->user()->city_ref) {
        $cityRef = auth()->user()->city_ref;
    } elseif (session('city_ref') !== null) {
        $cityRef = session('city_ref');
    }
    @endphp
    <div class="container">
        <h1>{{ __('order.order_placement') }}</h1>
        <div class="order row">
            <form action="{{ route('front.order.store') }}" method="POST" class="order__form col-12 col-md-6">
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
                                    <h4>1. {{ __('order.personal_data') }}</h4>
                                    <p class="customer-info">Имя: <span class="customer-name"></span></p>
                                    <p class="customer-info"> Телефон: <span class="customer-phone"></span></p>
                                </div>
                                <button class="edit-btn" type="button">{{ __('order.edit') }}</button>
                            </div>
                        </div>
                        <div class="order__order-form-group user-data">
                            <h4>1. {{ __('order.personal_data') }}</h4>
                            <input class="default-input" type="text" name="customer_phone"
                                   value="{{ auth()->user()?->phone }}" placeholder="{{ __('placeholders.phone') }}">
                            <input class="default-input" type="text" name="customer_name"
                                   value="{{ auth()->user()?->full_name }}" placeholder="{{ __('placeholders.name') }}">
                            <input class="default-input" type="email" name="email" value="{{ auth()->user()?->email }}"
                                   placeholder="{{ __('placeholders.email') }}">
                            <div>
                                <input id="switch" class="custom-switch" type="checkbox" name="anonymously" value="1">
                                <label for="switch">{{ __('order.send_anonymously') }}</label>
                            </div>
                            <button class="default-btn submit-user" type="button">{{ __('order.success') }}</button>
                        </div>
                    </div>
                </div>
                <div class="tab-content" id="regular">
                    <div class="order__user">
                        @guest()
                            <div class="order__order-form-group user-data">
                                <h4>1. {{ __('auth.login') }}</h4>
                                <input class="default-input" type="text" name="credential"
                                       placeholder="{{ __('auth.credential') }}">
                                <input class="default-input" type="password" name="password" placeholder="{{ __('auth.password') }}">

                                <button class="default-btn submit-login" type="button">{{ __('auth.sign_in') }}</button>
                            </div>
                        @endguest
                    </div>

                </div>
                <div class="order__delivery">
                    <div class="delivery-success">
                        <div class="d-flex justify-content-between align-content-start">
                            <div>
                                <h4>2. {{ __('order.delivery') }}</h4>
                                <p class="customer-info">{{ __('order.delivery') }}: <span class="delivery-address"></span></p>
                            </div>
                            <button class="edit-btn-delivery" type="button">{{ __('order.edit') }}</button>
                        </div>
                    </div>
                    <h4 class="delivery-header">2. {{ __('order.delivery') }}</h4>
                    <div class="order__order-form-group delivery-block">

                        <div class="d-flex">
                            <div class="delivery-tabs">
                                <div class="delivery-tab current-tab" id="delivery"><span>{{ __('order.delivery') }}</span></div>
                                <div class="delivery-tab" id="self-delivery"><span>{{ __('order.self_delivery') }}</span></div>
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
                                    <option value="9:00 - 11:00">9:00 - 11:00</option>
                                    <option value="11:00 - 13:00">11:00 - 13:00</option>
                                    <option value="13:00 - 15:00">13:00 - 15:00</option>
                                    <option value="15:00 - 17:00">15:00 - 17:00</option>
                                    <option value="17:00 - 19:00">17:00 - 19:00</option>
                                    <option value="19:00 - 21:00">19:00 - 21:00</option>
                                </select>
                            </div>
                            <input type="hidden" id="delivery_option" name="delivery_option" value="courier">
                        </div>
                        <div class="recipient-tabs">
                            <p class="recipient-tab current-tab" id="recipient">{{ __('order.is_gift') }}</p>
                            <p class="recipient-tab" id="customer">{{ __('order.i_am_recipient') }}</p>
                        </div>
                        <div class="recipient">
                            <input class="default-input" type="text" name="name" placeholder="{{ __('placeholders.recipient_name') }}">
                            <input class="default-input" type="text" name="phone" placeholder="{{ __('placeholders.phone') }}">
                        </div>

                        <button class="default-btn submit-delivery" type="button">{{ __('order.success') }}</button>
                    </div>
                </div>
                <div class="order__gifts">
                    <div class="gifts-success">
                        <div class="d-flex justify-content-between align-content-start">
                            <div>
                                <h4>3. {{ __('order.postcard_gifts') }}</h4>

                                <p class="customer-info">{{ __('order.postcard_text') }}: <span class="text-postcard"></span></p>
                            </div>
                            <button class="edit-btn-gifts" type="button">{{ __('order.edit') }}</button>
                        </div>
                    </div>

                    <h4 class="gifts-header">3. {{ __('order.postcard_gifts') }}</h4>
                    <div class="add-products">
                        <div class="gift">
                            <div id="giftCarousel" class="carousel slide carousel-fade">
                                <div class="carousel-inner">
                                    @php $products = \App\Models\Product::all(); @endphp
                                    @for($i = 0; $i < count($products); $i += 2)
                                        <div class="carousel-item {{ $i === 0 ? 'active' : '' }}">
                                            <div class="row">
                                                @foreach($products->slice($i, 2) as $product)
                                                    <div class="col-6 position-relative">
                                                        <div class="position-relative">
                                                            <img src="{{ $product->thumbnailUrl }}"
                                                                 class="d-block col-5 product-img"
                                                                 alt="{{ $product->title }}"
                                                                 data-product-id="{{ $product->id }}"
                                                            >
                                                        </div>
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
                                                    <div class="col-6 position-relative">
                                                        <div class="position-relative">
                                                            <img src="{{ $product->thumbnailUrl }}"
                                                                 class="d-block col-5 product-img"
                                                                 data-product-id="{{ $product->id }}"
                                                                 alt="{{ $product->title }}">
                                                        </div>
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
                            <button class="default-btn submit-gifts" type="button">{{ __('order.success') }}</button>

                        </div>
                    </div>
                </div>
                <div class="order__pay">
                    <div class="pay-success">
                        <h4>4. {{ __('order.payment') }}</h4>
                    </div>
                    <div class="pay-block">
                        <h4>4. {{ __('order.payment') }}</h4>
                        <div class="payment">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_method" value="bank"
                                       id="bank" checked>
                                <label class="form-check-label" for="bank">
                                    Онлайн-оплата карткою, Google Pay або Apple Pay
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_method" value="cash"
                                       id="cash" checked>
                                <label class="form-check-label" for="cash">
                                    {{ __('order.pay_on_shop') }}
                                </label>
                            </div>
                        </div>
                        @auth
                        <div class="bonus">
                            <input class="default-input" type="text" name="bonus" id="bonus" placeholder="{{ __('order.input_sum') }}">
                            <a id="pay-bonus" href="#">{{ __('order.pay_with_bonus') }}</a>
                        </div>
                        @endauth
                        <div class="comment">
                            <p id="comment-text">+ {{ __('order.add_comment') }}</p>
                        </div>
                        <div>
                            <input id="switch-call" class="custom-switch" type="checkbox" name="call" value="1">
                            <label for="switch-call">{{ __('order.not_call') }}</label>
                        </div>
                        @auth
                        <input type="hidden" name="user_id" value="{{ auth()->user()->getAuthIdentifier() }}">
                        @endauth
                        <button type="submit" class="default-btn">{{ __('order.order_place') }}</button>
                    </div>
                </div>
            </form>
            <div class="order__sum col-6 col-lg-5">
                @include('front.purchase.parts.order-cart')
            </div>
        </div>
    </div>

    <script>

        new AirDatepicker('#datepicker', {
            autoClose: false
        });


        var currentCityRef;
        var currentStreetRef;

        $(document).ready(function() {
            $('#cities_menu').hide();
            $('#streets_menu').hide();
            currentCityRef = '{{ $cityRef }}'

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

            function fetchStreets(searchValue) {
                $('.delivery-dropdown-item').remove();

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
