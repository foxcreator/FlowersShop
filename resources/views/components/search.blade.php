@php
    $products = \App\Models\Product::all()->take(3);
@endphp

<div class="search">
    <div class="container">
        <div class="search__header">
            <h1>{{ __('homepage.search') }}</h1>
            <div class="close-icon"></div>
        </div>
        <div class="search__input">
            <div class="custom-input">
                @svg('search')
                <input type="text" name="city_search">
            </div>
        </div>
        <div class="search__result">
            @foreach($products as $product)
                <a href="{{ route('front.product', $product->id) }}">
                    <div class="search__card">
                        <img src="{{ $product->thumbnailUrl }}" alt="{{ $product->name }}">
                        <p>{{ $product->title }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>
<script>
    function searchProducts(keyword) {
        document.querySelector('.search__result').innerHTML = '';

        fetch(`/search?keyword=${keyword}`)
            .then(response => response.json())
            .then(data => {
                data.forEach(product => {
                    const productLink = document.createElement('a');
                    productLink.href = product.url;

                    const productCard = document.createElement('div');
                    productCard.classList.add('search__card');

                    const productImage = document.createElement('img');
                    productImage.src = product.thumbnailUrl;
                    productImage.alt = product.title_uk;

                    const productName = document.createElement('p');
                    productName.textContent = product.title_uk;

                    productCard.appendChild(productImage);
                    productCard.appendChild(productName);
                    productLink.appendChild(productCard);
                    document.querySelector('.search__result').appendChild(productLink);
                });
            })
            .catch(error => console.error(error));
    }

    let timer;

    document.querySelector('.search__input input').addEventListener('input', function() {
        const keyword = this.value.trim();

        clearTimeout(timer);

        timer = setTimeout(function() {
            searchProducts(keyword); // Запускаем функцию поиска после задержки
        }, 1000);
    });
</script>

