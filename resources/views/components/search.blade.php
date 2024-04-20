@php
    $products = \App\Models\Product::all()->take(3);
@endphp

<div class="search">
    <div class="container">
        <div class="search__header">
            <h1>Поиск</h1>
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
                <a href="">
                    <div class="search__card">
                        <img src="{{ $product->thumbnailUrl }}" alt="{{ $product->name }}">
                        <p>{{ $product->title_ua }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>
<script>
    // Функция для выполнения AJAX-запроса
    function searchProducts(keyword) {
        // Очищаем результаты поиска
        document.querySelector('.search__result').innerHTML = '';

        // Выполняем AJAX-запрос
        fetch(`/search?keyword=${keyword}`)
            .then(response => response.json())
            .then(data => {
                // Обработка полученных данных
                data.forEach(product => {
                    // Создаем элементы для отображения каждого продукта
                    const productLink = document.createElement('a');
                    productLink.href = product.url;

                    const productCard = document.createElement('div');
                    productCard.classList.add('search__card');

                    const productImage = document.createElement('img');
                    productImage.src = product.thumbnailUrl;
                    productImage.alt = product.title_ua;

                    const productName = document.createElement('p');
                    productName.textContent = product.title_ua;

                    // Добавляем элементы на страницу
                    productCard.appendChild(productImage);
                    productCard.appendChild(productName);
                    productLink.appendChild(productCard);
                    document.querySelector('.search__result').appendChild(productLink);
                });
            })
            .catch(error => console.error(error));
    }

    // Обработчик события input для поля ввода поиска
    document.querySelector('.search__input input').addEventListener('input', function() {
        const keyword = this.value.trim(); // Получаем введенный текст

        if (keyword.length > 0) {
            searchProducts(keyword); // Выполняем поиск только если введен текст
        }
    });
</script>

