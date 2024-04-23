<div class="{{ $style }}__product-card">
    <div class="{{ $style }}__card-img">
        <a href="{{ route('front.product', $product->id) }}">
            <img src="{{ asset($product->thumbnailUrl) }}" alt="">
        </a>
        <div class="{{ $style }}__favorite"></div>
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

        console.log(cartCount);
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

            }
        })
    }
</script>
