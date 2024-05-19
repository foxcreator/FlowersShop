<div class="product-show__recommendation">
    <div class="product-show__for-you col-5 col-md-3 col-lg-2">
        <h3>{{ __('cart.special_for_you') }}</h3>
    </div>
    @foreach($randomProducts as $item)
        <div class="col-6 col-md-4">
            @include('components.product-card', ['product' => $item, 'style' => 'catalog'])
        </div>
    @endforeach
</div>
