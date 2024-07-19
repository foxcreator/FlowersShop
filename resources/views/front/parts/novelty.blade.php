@php
    $products = \App\Models\Product::where('is_novelty', true)->orderBy('order', 'asc')->get();
    if ($products->count() === 0) {
        $products = \App\Models\Product::query()->orderBy('article', 'desc')->take(5)->get();
    }
@endphp
<div class="container">
    <section class="novelty">
        <div class="novelty__header">
            <h1>{{ __('homepage.novelty') }}</h1>
        </div>

        <div class="novelty__products desktop">
            <div class="novelty__product-cards">
                @foreach($products as $product)
                        @include('components.product-card', ['product' => $product, 'style' => 'novelty'])
                @endforeach
            </div>
        </div>

        <div class="novelty__products mobile">

            <div class="novelty__product-cards row">
                @foreach($products as $product)
                        @include('components.product-card', ['product' => $product, 'style' => 'novelty'])
                @endforeach
            </div>
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
