@extends('front.layouts.app')
@section('content')
    @php
    $isFavorite = false;
    if (auth()->user()) {
        $isFavorite = auth()->user()->favoriteProducts()->where('product_id', $product->id)->exists();
    }
    @endphp
    <section class="product-show container">

        <div class="product-show__top row">
            <div class="product-show__gallery col-md-6 col-lg-5">
                <img class="product-show__thumbnail" src="{{ $product->thumbnailUrl }}" alt="{{ $product->title_uk }}">
                @if($product->productPhotos()->count() > 0)
                    <div class="product-show__images">
                        @foreach($product->productPhotos as $photo)
                            <img class="product-show__preview" src="{{ $photo->fileNameUrl }}" alt="">
                        @endforeach
                    </div>
                @endif
            </div>
            <div class="product-show__info col-md-6">
                <div class="product-show__text">
                    <div class="d-flex justify-content-between align-items-start gap-3">
                        <h1>{{ $product->title }}</h1>
                        <div class="product-show__favorite @if($isFavorite) is-favorite @endif" id="favorite_{{ $product->id }}" data-product-id="{{ $product->id }}">@svg('heart')</div>
                    </div>
                    <p class="article">Артикул {{ $product->article }}</p>
                </div>
                <form class="product-show__buy-block">
                    <div class="product-show__quantity">
                        <div class="quantity-input col-6">
                            <button type="button" class="minus-btn">@svg('minus')</button>
                            <input type="number" class="quantity-field" value="1">
                            <button type="button" class="plus-btn">@svg('plus')</button>
                        </div>

                        <p class="col-6">₴ <span class="price">{{ intval($product->price) }}</span></p>
                    </div>
                    <button type="button"
                            onclick="addToCart('{{ $product->id }}')"
                            class="product-show__btn"
                    >
                        {{ __('product_show.add_to_cart') }}
                    </button>
                </form>
            </div>
        </div>

        <div class="product-show__bottom">
            <div class="product-show__tabs">
                <div class="tab active" data-tab="tab1"><span>{{ __('product_show.flower_story') }}</span></div>
                <div class="tab" data-tab="tab2"><span>{{ __('product_show.delivery_payment') }}</span></div>
                <div class="tab" data-tab="tab3"><span>{{ __('product_show.reviews') }}</span></div>
            </div>

            <div class="tab-content active" id="tab1">
                <img src="{{ $product->thumbnailUrl }}" alt="{{ $product->title }}">
                <p>{{ $product->description }}</p>
            </div>

            <div class="tab-content" id="tab2">
                <div style="width: 33.333%">
                    <h3>Оплата</h3>
                    <ul>
{{--                        <li>Fondy</li>--}}
{{--                        <li>{{ __('product_show.checking_account') }}</li>--}}
                        <li>{{ __('product_show.on_receiving') }}</li>
                    </ul>
                </div>
                <div style="width: 33.333%">
                    <h3>Доставка</h3>
                    <ul>
                        <li>{{ __('product_show.courier') }}</li>
                        <li>{{ __('product_show.self_delivery') }}</li>
                    </ul>
                </div>
            </div>

            <div class="tab-content" id="tab3">
                <div class="comments">
                    <form action="{{ route('front.comments.store') }}" method="POST">
                        @csrf
                        <input type="text" name="user_name" placeholder="{{ __('homepage.your_name') }}"
                               @if(auth()->user()) value="{{ auth()->user()->name }} @endif ">
                        <textarea name="content"></textarea>
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <button type="submit">{{ __('product_show.send') }}</button>
                    </form>
                    <div class="all-comments">

                        <div class="custom-overlay">
                            <div id="loader" class="spinner-border text-grey loader" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>

                        @include('components.comments', ['comments' => $comments])
                    </div>
                </div>
            </div>
        </div>

        @include('components.recommendation', ['randomProducts' => $randomProducts])
    </section>
    <script>
        function addToCart(productId) {
            $.ajax({
                url: "{{ route('front.addToCart') }}",
                type: "POST",
                data: {
                    id: productId,
                    quantity: $('.quantity-field').val()
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: (data) => {
                    $('.cart-count').text(data.cartCount);
                    showToast('toast-success', '{{ __('statuses.cart_add') }}');
                },
                error: (xhr) => {
                    showToast('toast-error', xhr.responseJSON.error);
                }
            })
        }

        $(document).ready(function () {
            $('.product-show__preview').click(function () {
                var newSrc = $(this).attr('src');
                $('.product-show__thumbnail').addClass('fade-out');
                setTimeout(function () {
                    $('.product-show__thumbnail').attr('src', newSrc).removeClass('fade-out');
                }, 300);
            });

            var maxQuantity = parseInt("{{ $product->quantity - $cartQuantity }}");
            var pricePerUnit = parseInt("{{ $product->price }}");

            if (maxQuantity === 0) {
                $('.quantity-field').val(0);
                $('.product-show__btn').addClass('max-quantity');
                updateTotalPrice()
            }

            $('.minus-btn').click(function () {
                var currentValue = parseInt($('.quantity-field').val());
                if (currentValue > 1) {
                    $('.quantity-field').val(currentValue - 1);
                    $('.plus-btn').removeClass('disabled');
                }
                if ($('.quantity-field').val() === "1") {
                    $(this).addClass('disabled');
                }
                updateTotalPrice();
            });

            $('.plus-btn').click(function () {
                var currentValue = parseInt($('.quantity-field').val());
                if (currentValue < maxQuantity) {
                    $('.quantity-field').val(currentValue + 1);
                    $('.minus-btn').removeClass('disabled');
                }
                if ($('.quantity-field').val() === maxQuantity.toString()) {
                    $(this).addClass('disabled');
                }
                updateTotalPrice();
            });

            $('.quantity-field').on('input', function () {
                var currentValue = parseInt($(this).val());
                if (isNaN(currentValue) || currentValue < 1) {
                    $(this).val(1);
                } else if (currentValue > maxQuantity) {
                    $(this).val(maxQuantity);
                }
                if ($(this).val() === "1") {
                    $('.minus-btn').addClass('disabled');
                    $('.plus-btn').removeClass('disabled');
                } else if ($(this).val() === maxQuantity.toString()) {
                    $('.plus-btn').addClass('disabled');
                    $('.minus-btn').removeClass('disabled');
                } else {
                    $('.minus-btn, .plus-btn').removeClass('disabled');
                }
                updateTotalPrice();
            });

            $('.tab').click(function () {
                var tabId = $(this).data('tab');
                $(this).addClass('active').siblings().removeClass('active');
                $('#' + tabId).addClass('active').siblings().removeClass('active');
            });

            $(document).on('click', '.custom-pagination__page-link', function (event) {
                event.preventDefault();
                var page = $(this).text();
                fetchComments(page);
            });

            function fetchComments(page = 1) {
                var url = `/product/{{$product->id}}?page=${page}`;
                $.ajax({
                    url: url,
                    method: 'GET',
                    contentType: 'application/json',
                    success: function (data) {
                        updateCommentsList(data);
                    },
                    error: function (error) {
                        console.error(error);
                    }
                });
            }

            function updateCommentsList(data) {
                $('.all-comments').html(data.html.comments);
                $('.comments-paginate').html(data.html.paginate);
            }

            function updateTotalPrice() {
                var quantity = parseInt($('.quantity-field').val());
                $('.price').text(quantity * pricePerUnit);
            }
        });

        $('#favorite_{{ $product->id }}').on('click', function() {
            var productId = $(this).data('product-id');
            var $button = $(this);

            $.ajax({
                url: '/toggle-favorite',
                type: 'POST',
                data: {
                    id: productId
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.status === 'add') {
                        $button.addClass('is-favorite');
                        showToast('toast-success', '{{ __('statuses.favorite_add') }}');
                    } else if (response.status === 'delete') {
                        $button.removeClass('is-favorite');
                        showToast('toast-success', '{{ __('statuses.favorite_delete') }}');
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
    </script>
@endsection
