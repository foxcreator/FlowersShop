@foreach($products->skip(4) as $index => $product)
    <div class="col-md-4">
        @include('components.product-card', ['product' => $product, 'style' => 'catalog'])
    </div>
@endforeach
