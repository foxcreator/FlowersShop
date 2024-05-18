@php
    $products = \App\Models\Product::all()->take(5);
@endphp
<div class="container mt-200">
    <section class="novelty">
        <div class="novelty__header">
            <h1>{{ __('homepage.novelty') }}</h1>
        </div>

        <div class="novelty__products desktop">
            @foreach($products as $product)
                @if($loop->first)
                    <div class="novelty__product-card--first">
                        <div class="novelty__card-img">
                            <a href="{{ route('front.product', $product->id) }}">
                                <img src="{{ $product->thumbnailUrl }}" alt="{{ $product->title }}">
                            </a>
                            <div class="novelty__favorite"></div>
                            <button type="button" class="novelty__buy-btn">
                                {{ __('homepage.add_to_cart') }}
                                @svg('cart')
                            </button>
                        </div>
                        <a href="{{ route('admin.products.index') }}">
                            <div class="novelty__info">
                                <p class="novelty__product-name">{{ $product->title }}</p>
                                <p class="novelty__product-price">₴ {{ $product->price }}</p>
                            </div>
                        </a>
                    </div>
                @endif
            @endforeach

            <div class="novelty__product-cards">
                @foreach($products as $product)
                    @if(!$loop->first)
                        @include('components.product-card', ['product' => $product, 'style' => 'novelty'])
                    @endif
                @endforeach
            </div>
        </div>

        <div class="novelty__products mobile">

            <div class="novelty__product-cards row">
                @foreach($products as $product)
                    @if(!$loop->last)
                        @include('components.product-card', ['product' => $product, 'style' => 'novelty'])
                    @endif
                @endforeach
            </div>
            @foreach($products as $product)
                @if($loop->last)
                    <div class="novelty__product-card--first">
                        <div class="novelty__card-img">
                            <a href="{{ route('front.product', $product->id) }}">
                                <img src="{{ $product->thumbnailUrl }}" alt="{{ $product->title }}">
                            </a>
                            <div class="novelty__favorite"></div>
                            <button type="button" class="novelty__buy-btn">
                                {{ __('homepage.add_to_cart') }}
                                @svg('cart')
                            </button>
                        </div>
                        <a href="{{ route('admin.products.index') }}">
                            <div class="novelty__info">
                                <p class="novelty__product-name">{{ $product->title }}</p>
                                <p class="novelty__product-price">₴ {{ $product->price }}</p>
                            </div>
                        </a>
                    </div>
                @endif
            @endforeach
        </div>

        <div class="novelty__link-block">
            <a href="{{ route('front.catalog') }}" class="novelty__link">
                <span>{{ __('homepage.all_novelty') }}</span>
                @svg('arrow-circle-right')
            </a>
        </div>
    </section>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var buyButtons = document.querySelectorAll('.novelty__buy-btn');
        buyButtons.forEach(function(button) {
            button.addEventListener('click', function(event) {
                event.preventDefault(); // Отмена перехода по ссылке по умолчанию
                // var productUrl = this.getAttribute('data-product-url');
                // Здесь выполняй аякс-запрос на добавление товара в корзину
                // Используй productUrl для выполнения запроса
                console.log('Добавление товара в корзину:');
            });
        });
    });


</script>
