@php
    $delivery = 0;
    if (\Cart::session(session('cart_id'))->getTotal() < 2500) {
        $delivery = 250;
    }
@endphp
<div class="order__sum--header">
    <h3>{{ __('order.your_order') }}</h3>
    <a href="{{ route('front.cart') }}">{{ __('order.edit') }}</a>
</div>
<div class="order__sum--cart">
    @foreach(\Cart::session(session('cart_id'))->getContent() as $product)
        <div class="order__sum--product">
            <div class="d-flex gap-2">
                <img src="{{ $product->attributes->img }}" alt="{{ $product->title }}">
                <div class="text-block">
                    <h4>{{ $product->name }}</h4>
                    <p>{{ __('order.count') }}: {{ $product->quantity }}</p>
                    <p>{{ __('order.package') }}</p>
                </div>
            </div>
            <p>₴ {{ $product->getPriceSum() }}</p>
        </div>
    @endforeach
</div>
<div class="order__sum--total">
    <div class="block">
        <p>{{ __('order.delivery') }}:</p>
        @if($delivery !== 0)
            <p>₴ {{ $delivery }}</p>
        @else
            <p>{{ __('order.free') }}</p>
        @endif
    </div>
    <div class="block">
        <p>{{ __('order.total') }}:</p>
        <h3>₴ <span id="total">{{ \Cart::session(session('cart_id'))->getTotal() + $delivery }}</span></h3>
    </div>
</div>
