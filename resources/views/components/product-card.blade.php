@php
$isFavorite = false;
if (auth()->user()) {
    $isFavorite = auth()->user()->favoriteProducts()->where('product_id', $product->id)->exists();
}
@endphp

<div class="{{ $style }}__product-card">
    <div class="{{ $style }}__card-img">
        <a href="{{ route('front.product', $product->id) }}">
            <img src="{{ asset($product->thumbnailUrl) }}" alt="">
        </a>
        <div class="{{ $style }}__favorite @if($isFavorite) is-favorite @endif" id="favorite_{{ $product->id }}" data-product-id="{{ $product->id }}">@svg('heart')</div>
        <button id="add-to-cart_{{ $product->id }}" type="button" class="{{ $style }}__buy-btn" onclick="addToCart('{{ $product->id }}')">
            {{ __('homepage.add_to_cart') }}
            @svg('cart')
        </button>
    </div>
    <a href="{{ route('front.product', $product->id) }}">
        <div class="{{ $style }}__info">
            <p class="{{ $style }}__product-name">{{ $product->title }}</p>
            <p class="{{ $style }}__product-price">₴ {{ intval($product->price) }}</p>
        </div>
    </a>
</div>

<script>
    function addToCart(productId) {
        let cartCount = parseInt($('.cart-count').text());

        $('.cart-count').text(cartCount += 1);

        $.ajax({
            url: "{{ route('front.addToCart') }}",
            type: "POST",
            data: {
                id: productId,
                quantity: 1
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: (data) => {
                console.log(data)
                showToast('toast-success', data.data);
            },
            error: (xhr) => {
                showToast('toast-error', xhr.responseJSON.error);
            }

        })
    }

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
