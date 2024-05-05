<div class="order__sum--header">
    <h3>Ваш заказ</h3>
    <a href="{{ route('front.cart') }}">Редактировать</a>
</div>
<div class="order__sum--cart">
    @foreach(\Cart::session(session('cart_id'))->getContent() as $product)
        <div class="order__sum--product">
            <div class="d-flex gap-2">
                <img src="{{ $product->attributes->img }}" alt="{{ $product->title }}">
                <div class="text-block">
                    <h4>{{ $product->name }}</h4>
                    <p>Количество: {{ $product->quantity }}</p>
                    <p>Упаковка: крафт</p>
                </div>
            </div>
            <p>₴ {{ $product->getPriceSum() }}</p>
        </div>
    @endforeach
</div>
<div class="order__sum--total">
    <div class="block">
        <p>Доставка:</p>
        <p>Бесплатно</p>
    </div>
    <div class="block">
        <p>Всего к оплате:</p>
        <h3>₴ <span id="total">{{ \Cart::session(session('cart_id'))->getTotal() }}</span></h3>
    </div>
</div>
