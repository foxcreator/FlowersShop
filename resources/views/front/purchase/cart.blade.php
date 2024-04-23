@extends('front.layouts.app')
@section('content')

    @php $randomProducts = \App\Models\Product::take(5)->get(); @endphp
    <div class="cart container">
{{--        @dd($cartData)--}}
        @if(!$cartData->isEmpty())
        <h1>Ваш заказ</h1>
        <div class="cart__items">
            @foreach($cartData as $product)
                <div class="cart__item">
                    <div class="cart__product">
                        <img src="{{ $product->attributes->img }}" alt="{{ $product->name }}">
                        <div class="cart__product-info">
                            <h4>{{ $product->name }}</h4>
                            <p>Упаковка: Крафт</p>
                        </div>
                    </div>
                    <div class="cart__count">
                        <div class="quantity-input">
                            <button type="button" class="minus-btn">@svg('minus')</button>
                            <input type="number" class="quantity-field" value="{{ $product->quantity }}">
                            <button type="button" class="plus-btn">@svg('plus')</button>
                        </div>
                        <h5 class="cart__sum">₴ {{ intval($product->price) * $product->quantity }}</h5>
                    </div>
                    <div class="cart__item-delete">
                        <a href="#">@svg('bin')</a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="cart__promo-code">
{{--            <input type="text">--}}
{{--            <button type="submit"></button>--}}
        </div>
        <div class="cart__bottom">
            <div class="total-amount">
                <p>Всего к оплате: </p>
                <span>₴ {{ \Cart::getTotal() }}</span>
            </div>
            <a href="#" class="cart__btn-submit">Оформить заказ</a>
            <a href="{{ route('front.catalog') }}" class="cart__btn-back">Продолжить покупки</a>
            @include('components.recommendation', ['randomProducts' => $randomProducts])
        </div>
        @else
            <div class="cart__is-empty">
                <h2 class="text-center">Корзина пуста</h2>
            </div>
            @include('components.recommendation', ['randomProducts' => $randomProducts])
        @endif
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const quantityInput = document.querySelector('.quantity-field');
        const minusBtn = document.querySelector('.minus-btn');
        const plusBtn = document.querySelector('.plus-btn');
        {{--const maxQuantity = parseInt("{{ $product->quantity }}");--}}
        {{--const pricePerUnit = <?php echo intval($product->price); ?>;--}}
        const totalPrice = document.querySelector('.price');

        if (quantityInput.value === "1") {
            minusBtn.classList.add('disabled');
        }
        // Уменьшение количества
        minusBtn.addEventListener('click', function () {
            let currentValue = parseInt(quantityInput.value);
            if (currentValue > 1) {
                quantityInput.value = currentValue - 1;
                plusBtn.classList.remove('disabled');
            }
            if (quantityInput.value === "1") {
                minusBtn.classList.add('disabled');
            }
            updateTotalPrice()

        });

        // Увеличение количества
        plusBtn.addEventListener('click', function () {
            let currentValue = parseInt(quantityInput.value);
            if (currentValue < maxQuantity) {
                quantityInput.value = currentValue + 1;

                minusBtn.classList.remove('disabled');
            }
            if (quantityInput.value === maxQuantity.toString()) {
                plusBtn.classList.add('disabled');
            }
            updateTotalPrice()

        });

        // Ограничение ввода вручную
        quantityInput.addEventListener('input', function () {
            let currentValue = parseInt(quantityInput.value);
            if (isNaN(currentValue) || currentValue < 1) {
                quantityInput.value = 1;
            } else if (currentValue > maxQuantity) {
                quantityInput.value = maxQuantity;
            }
            if (quantityInput.value === "1") {
                minusBtn.classList.add('disabled');
                plusBtn.classList.remove('disabled');
            } else if (quantityInput.value === maxQuantity.toString()) {
                plusBtn.classList.add('disabled');
                minusBtn.classList.remove('disabled');
            } else {
                minusBtn.classList.remove('disabled');
                plusBtn.classList.remove('disabled');
            }
            updateTotalPrice()
        });

        function updateTotalPrice() {
            console.log('update')
            const quantity = parseInt(quantityInput.value);
            totalPrice.textContent = quantity * pricePerUnit;
        }



        const tabs = document.querySelectorAll('.tab');
        const tabContents = document.querySelectorAll('.tab-content');

        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                const tabId = tab.getAttribute('data-tab');
                tabs.forEach(t => {
                    t.classList.remove('active');
                });
                // Hide all tab contents
                tabContents.forEach(content => {
                    content.classList.remove('active');
                });

                // Show the selected tab content
                const selectedTabContent = document.getElementById(tabId);
                selectedTabContent.classList.add('active');
                tab.classList.add('active');
            });
        });
    });
</script>
