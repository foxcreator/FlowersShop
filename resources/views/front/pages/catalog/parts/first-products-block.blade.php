@foreach($products->take(4) as $index => $product)
<div class="col-lg-6 col-md-12 col-sm-6 col-6 four-product">
    @include('components.product-card', ['product' => $product, 'style' => 'catalog'])
</div>
@endforeach

@foreach($products->take(2) as $index => $product)
<div class="col-lg-6 col-md-12 col-sm-6 col-6 two-product">
    @include('components.product-card', ['product' => $product, 'style' => 'catalog'])
</div>
@endforeach
