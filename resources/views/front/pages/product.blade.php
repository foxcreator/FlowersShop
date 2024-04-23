@extends('front.layouts.app')
@section('content')
    <section class="product-show" style="padding: 150px">

        <div class="product-show__top">
            <div class="product-show__gallery">
                <img class="product-show__thumbnail" src="{{ $product->thumbnailUrl }}" alt="{{ $product->title_uk }}">
                <div class="product-show__images">
                    @foreach($product->productPhotos as $photo)
                        <img class="product-show__preview" src="{{ $photo->fileNameUrl }}" alt="">
                    @endforeach
                </div>
            </div>
            <div class="product-show__info">
                <div class="product-show__text">
                    <h1>{{ $product->title }}</h1>
                    <p class="article">Артикул {{ $product->article }}</p>
                </div>
                <form class="product-show__buy-block">
                    <div class="product-show__quantity">
                        <div class="quantity-input">
                            <button type="button" class="minus-btn">@svg('minus')</button>
                            <input type="number" class="quantity-field" value="1">
                            <button type="button" class="plus-btn">@svg('plus')</button>
                        </div>

                        <p>₴ <span class="price">{{ intval($product->price) }}</span></p>
                    </div>
                    <button type="submit" class="product-show__btn">{{ __('product_show.add_to_cart') }}</button>
                </form>
            </div>
        </div>

        <div class="product-show__bottom">
            <div class="product-show__tabs">
                <div class="tab active" data-tab="tab1"><span>{{ __('product_show.flower_story') }}</span></div>
                <div class="tab" data-tab="tab2"><span>{{ __('product_show.delivery_payment') }}</span></div>
                <div class="tab" data-tab="tab3"><span>{{ __('product_show.reviews') }}</span></div>
            </div>

            <div class="tab-content active" id="tab1">
                <img src="{{ $product->thumbnailUrl }}" alt="{{ $product->title }}">
                <p>{{ $product->description }}</p>
            </div>

            <div class="tab-content" id="tab2">
                <div style="width: 33.333%">
                    <h3>Оплата</h3>
                    <ul>
                        <li>LiqPay</li>
                        <li>{{ __('product_show.checking_account') }}</li>
                        <li>{{ __('product_show.on_receiving') }}</li>
                    </ul>
                </div>
                <div style="width: 33.333%">
                    <h3>Доставка</h3>
                    <ul>
                        <li>{{ __('product_show.courier') }}</li>
                        <li>{{ __('product_show.self_delivery') }}</li>
                    </ul>
                </div>
            </div>

            <div class="tab-content" id="tab3">
                <div class="comments">
                    <form action="{{ route('front.comments.store') }}" method="POST">
                        @csrf
                        <input type="text" name="user_name" placeholder="{{ __('homepage.your_name') }}" @if(auth()->user()) value="{{ auth()->user()->name }} @endif ">
                        <textarea name="content"></textarea>
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <button type="submit">{{ __('product_show.send') }}</button>
                    </form>
                    <div class="all-comments">

                        <div class="custom-overlay">
                            <div id="loader" class="spinner-border text-grey loader" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>

                        @include('components.comments', ['comments' => $comments])
                    </div>
                </div>
            </div>
        </div>

        @include('components.recommendation', ['randomProducts' => $randomProducts])
    </section>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const thumbnail = document.querySelector('.product-show__thumbnail');
        const previews = document.querySelectorAll('.product-show__preview');

        previews.forEach(image => {
            image.addEventListener('click', function() {
                const newSrc = this.src;
                thumbnail.classList.add('fade-out');

                setTimeout(function() {
                    thumbnail.src = newSrc;
                    thumbnail.classList.remove('fade-out');
                }, 300); // Задержка, чтобы анимация завершилась перед изменением src
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
        const quantityInput = document.querySelector('.quantity-field');
        const minusBtn = document.querySelector('.minus-btn');
        const plusBtn = document.querySelector('.plus-btn');
        const maxQuantity = parseInt("{{ $product->quantity }}");
        const pricePerUnit = <?php echo intval($product->price); ?>;
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

    document.addEventListener('DOMContentLoaded', function () {


        document.addEventListener('click', function (event) {
            if (event.target.classList.contains('custom-pagination__page-link')) {
                event.preventDefault();
                const page = event.target.textContent;
                console.log(page);
                fetchComments(page);
            }
        });

        function fetchComments(page = 1) {

            let url = `/product/{{$product->id}}?page=${page}`;

            fetch(url, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                },
            })
                .then(response => response.json())
                .then(data => {
                    updateCommentsList(data);
                })
                .catch(error => console.error(error));
        }
    });


    function updateCommentsList(data) {
        const paginate = document.querySelector('.comments-paginate');
        const comments = document.querySelector('.all-comments');

        comments.innerHTML = data.html.comments;
        paginate.innerHTML = data.html.paginate;
    }


</script>
