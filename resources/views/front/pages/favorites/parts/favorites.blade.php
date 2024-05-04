<div class="favorite row">
    @foreach($products as $product)
        <div class="col-md-4">
            @include('components.product-card', ['product' => $product, 'style' => 'catalog'])
        </div>
    @endforeach
</div>
