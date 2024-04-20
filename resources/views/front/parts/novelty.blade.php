@php
    $products = \App\Models\Product::all()->take(4);
@endphp
<div class="container mt-200">
    <section class="novelty">
        <div class="novelty__header">
            <h1>Новинки</h1>
        </div>

        <div class="novelty__products">
                <div class="novelty__product-card--first">
                    <div class="novelty__card-img">
                        <a href="{{ route('admin.products.index') }}">
                            <img src="{{ asset('front/images/test-product.png') }}" alt="">
                        </a>
                        <div class="novelty__favorite"></div>
                        <button type="button" class="novelty__buy-btn">
                            В кошик
                            @svg('cart')
                        </button>
                    </div>
                    <a href="{{ route('admin.products.index') }}">
                        <div class="novelty__info">
                            <p class="novelty__product-name">Рожеві троянди</p>
                            <p class="novelty__product-price">₴ 1200</p>
                        </div>
                    </a>
                </div>
            <div class="novelty__product-cards">
                @foreach($products as $product)
                    @include('components.product-card', ['product' => $product, 'style' => 'novelty'])
                @endforeach
            </div>
        </div>

        <div class="novelty__link-block">
            <a href="#" class="novelty__link">
                <span>Все новинки</span>
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
