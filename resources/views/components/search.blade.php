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
    document.addEventListener('DOMContentLoaded', function () {
        var dropdownToggle = document.querySelector('.search-toggle');
        var dropdown = document.querySelector('.search');
        var close = document.querySelector('.close-icon');

        dropdownToggle.addEventListener('click', function (event) {
            event.preventDefault(); // Предотвращаем переход по ссылке
            dropdown.classList.toggle('open');
            document.body.classList.toggle('fix');
            event.stopPropagation(); // Остановить всплытие события, чтобы клик на кнопке не вызывал закрытие всех дропдаунов
        });

        // Обработчик события click на документе для закрытия всех дропдаунов при клике в любом месте страницы
        close.addEventListener('click', function (event) {
            dropdown.classList.remove('open');
            document.body.classList.remove('fix');
        });
    });
</script>
