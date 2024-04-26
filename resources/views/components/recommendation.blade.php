<div class="product-show__recommendation">
    <div class="product-show__for-you col-md-2">
        <h3>Рекомендуем лично для тебя</h3>
    </div>
    @foreach($randomProducts as $item)
        <div class="col-md-4">
            @include('components.product-card', ['product' => $item, 'style' => 'catalog'])
        </div>
    @endforeach
</div>
