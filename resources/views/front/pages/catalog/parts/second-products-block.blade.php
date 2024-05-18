@foreach($products->skip(4) as $index => $product)
    <div class="col-lg-4 col-md-6 col-sm-6 col-6 four-product">
        @include('components.product-card', ['product' => $product, 'style' => 'catalog'])
    </div>
@endforeach
@foreach($products->skip(2) as $index => $product)
    <div class="col-lg-4 col-md-6 col-sm-6 col-6 two-product">
        @include('components.product-card', ['product' => $product, 'style' => 'catalog'])
    </div>
@endforeach
