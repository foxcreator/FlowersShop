@extends('front.layouts.app')
@section('content')

    @php $randomProducts = App\Models\Product::orderBy('rating', 'DESC')->limit(5)->get(); @endphp
    <div class="cart container">
        @if(!$cartData->isEmpty())
            <h1>{{ __('cart.your-order') }}</h1>
            <div class="cart__items">
                @foreach($cartData as $product)
                    <div class="cart__item">
                        <div class="cart__product col-8 col-md-6">
                            <img src="{{ $product->attributes->img }}" alt="{{ $product->name }}">
                            <div class="cart__product-info">
                                <h4>{{ $product->name }}</h4>
                                <p>{{ __('cart.package') }}: Крафт</p>
                            </div>
                        </div>
                        <div class="cart__count col-4 col-md-5">
                            <div class="quantity-input">
                                <button type="button" class="minus-btn">@svg('minus')</button>
                                <input type="number" class="quantity-field" value="{{ $product->quantity }}" data-max="23" data-id="{{ $product->id }}">
                                <button type="button" class="plus-btn">@svg('plus')</button>
                            </div>
                            <h5 class="cart__sum">₴ {{ intval($product->price) * $product->quantity }}</h5>
                        </div>
                        <form action="{{ route('front.removeItem', $product->id) }}" method="POST" class="cart__item-delete col-1">
                            @csrf
                            <button type="submit">@svg('bin')</button>
                        </form>
                    </div>
                @endforeach
            </div>
            <div class="cart__promo-code">
                {{--            <input type="text">--}}
                {{--            <button type="submit"></button>--}}
            </div>
            <div class="cart__bottom">
                <div class="total-amount col-10 col-lg-7">
                    <p>{{ __('cart.total-sum') }}: </p>
                    <span class="price">₴ {{ \Cart::getTotal() }}</span>
                </div>
                <a href="{{ route('front.orderPage') }}" class="cart__btn-submit col-11 col-md-10 col-lg-7">{{ __('cart.get-order') }}</a>
                <a href="{{ route('front.catalog') }}" class="cart__btn-back col-11 col-md-10 col-lg-7">{{ __('cart.continue-shop') }}</a>
                @include('components.recommendation', ['randomProducts' => $randomProducts])
            </div>
        @else
            <div class="cart__is-empty">
                <h2 class="text-center">{{ __('cart.cart-empty') }}</h2>
            </div>
            @include('components.recommendation', ['randomProducts' => $randomProducts])
        @endif
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('.cart__item').each(function () {
            const maxQuantity = parseInt($(this).find('.quantity-field').data('max'));
            const pricePerUnit = parseInt($(this).find('.cart__sum').text().replace('₴ ', ''));

            $(this).find('.minus-btn').click(function () {
                let quantityField = $(this).siblings('.quantity-field');
                let currentValue = parseInt(quantityField.val());
                if (currentValue > 1) {
                    quantityField.val(currentValue - 1);
                    $(this).siblings('.plus-btn').removeClass('disabled');
                    updateQuantity(quantityField.data('id'), currentValue - 1);
                }
                if (quantityField.val() === "1") {
                    $(this).addClass('disabled');
                }
            });

            $(this).find('.plus-btn').click(function () {
                let quantityField = $(this).siblings('.quantity-field');
                let currentValue = parseInt(quantityField.val());
                if (currentValue < maxQuantity) {
                    quantityField.val(currentValue + 1);
                    $(this).siblings('.minus-btn').removeClass('disabled');
                    updateQuantity(quantityField.data('id'), currentValue + 1);
                }
                if (quantityField.val() === maxQuantity.toString()) {
                    $(this).addClass('disabled');
                }
            });

            $(this).find('.quantity-field').on('input', function () {
                let currentValue = parseInt($(this).val());
                if (isNaN(currentValue) || currentValue < 1) {
                    $(this).val(1);
                } else if (currentValue > maxQuantity) {
                    $(this).val(maxQuantity);
                }
                if ($(this).val() === "1") {
                    $(this).siblings('.minus-btn').addClass('disabled');
                    $(this).siblings('.plus-btn').removeClass('disabled');
                } else if ($(this).val() === maxQuantity.toString()) {
                    $(this).siblings('.plus-btn').addClass('disabled');
                    $(this).siblings('.minus-btn').removeClass('disabled');
                } else {
                    $(this).siblings('.minus-btn, .plus-btn').removeClass('disabled');
                }
                updateQuantity($(this).data('id'), currentValue);
            });
        });
    });


    function addToCart(productId, quantity) {
        let cartCount = parseInt($('.cart-count').text());

        $('.cart-count').text(cartCount += quantity);

        $.ajax({
            url: "{{ route('front.addToCart') }}",
            type: "POST",
            data: {
                id: productId,
                quantity: quantity
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: (data) => {
                showToast('toast-success', data.data);
                setTimeout(function () {
                    window.location.reload();
                }, 500)
            },
            error: (xhr) => {
                showToast('toast-error', xhr.responseJSON.error);
            }

        })
    }

    function updateQuantity(productId, quantity) {
        let cartCount = parseInt($('.cart-count').text());

        $('.cart-count').text(cartCount += quantity);

        $.ajax({
            url: "{{ route('front.updateQuantity') }}",
            type: "POST",
            data: {
                id: productId,
                quantity: quantity
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: (data) => {
                showToast('toast-success', data.data);
                setTimeout(function () {
                    window.location.reload();
                }, 1000)
            },
            error: (xhr) => {
                showToast('toast-error', xhr.responseJSON.error);
            }

        })
    }
</script>
