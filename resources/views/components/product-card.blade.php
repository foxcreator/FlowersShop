<div class="{{ $style }}__product-card">
    <div class="{{ $style }}__card-img">
        <a href="{{ route('front.product', $product->id) }}">
            <img src="{{ asset($product->thumbnailUrl) }}" alt="">
        </a>
        <div class="{{ $style }}__favorite"></div>
        <button type="button" class="{{ $style }}__buy-btn">
            В кошик
            @svg('cart')
        </button>
    </div>
    <a href="{{ route('front.product', $product->id) }}">
        <div class="{{ $style }}__info">
            <p class="{{ $style }}__product-name">{{ $product->title_ua }}</p>
            <p class="{{ $style }}__product-price">₴ {{ $product->price }}</p>
        </div>
    </a>
</div>
