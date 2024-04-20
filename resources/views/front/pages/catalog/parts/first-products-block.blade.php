@foreach($products->take(4) as $index => $product)
    <div class="col-md-6">
        @include('components.product-card', ['product' => $product, 'style' => 'catalog'])
    </div>
@endforeach
