@extends('front.layouts.app')
@section('content')
    <section class="catalog" style="padding: 150px">
        <div class="container">
            <h1>Каталог</h1>
            <div class="catalog__wrapper">
                <div class="overflow"></div>
                <div id="loader" class="spinner-border text-grey" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>

                <div class="row">
                    <div class="catalog__filter col-md-4">
                        <div class="accordion">
                            <div class="accordion-item active">
                                <div class="accordion-header">
                                    <p><span></span>Категории</p>
                                    @svg('circle-arrow')
                                </div>
                                <div class="accordion-content">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="category_id" value="all" id="flexRadioDefault_all">
                                        <label class="form-check-label" for="flexRadioDefault_all">
                                            Все
                                        </label>
                                    </div>
                                    @foreach($categories as $category)
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="category_id" value="{{ $category->id }}" id="flexRadioDefault_{{ $category->id }}">
                                            <label class="form-check-label" for="flexRadioDefault_{{ $category->id }}">
                                                {{ $category->title_ua }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="accordion-item">
                                <div class="accordion-item">
                                    <div class="accordion-header">
                                        <p><span></span>Цветок</p>
                                        @svg('circle-arrow')
                                    </div>
                                    <div class="accordion-content">
                                        @foreach($categories as $category)
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flower" id="flexRadioDefault_{{ $category->id }}">
                                                <label class="form-check-label" for="flexRadioDefault_{{ $category->id }}">
                                                    {{ $category->title_ua }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <div class="accordion-item">
                                    <div class="accordion-header">
                                        <p><span></span>Тематика</p>
                                        @svg('circle-arrow')
                                    </div>
                                    <div class="accordion-content">
                                        @foreach($categories as $category)
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="theme" id="flexRadioDefault_{{ $category->id }}">
                                                <label class="form-check-label" for="flexRadioDefault_{{ $category->id }}">
                                                    {{ $category->title_ua }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="price">
                                <p><span></span>Цена</p>
                                @svg('circle-arrow')
                            </div>
                            <div id="slider"></div>
                            <div class="d-flex justify-content-between mt-2 w-100">
                                <p>₴<span id="minPrice"></span> </p>
                                <p>₴<span id="maxPrice"></span> </p>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-8">
                        <div class="row first-block">
                            @foreach($products->take(4) as $index => $product)
                                <div class="col-md-6">
                                    @include('components.product-card', ['product' => $product, 'style' => 'catalog'])
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="row second-block">
                    @foreach($products->skip(4) as $index => $product)
                        <div class="col-md-4">
                            @include('components.product-card', ['product' => $product, 'style' => 'catalog'])
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var accordionHeaders = document.querySelectorAll('.accordion-item > .accordion-header');

            accordionHeaders.forEach(function(header) {
                header.addEventListener('click', function() {
                    var item = this.parentNode;
                    item.classList.toggle('active');

                    accordionHeaders.forEach(function(otherHeader) {
                        var otherItem = otherHeader.parentNode;
                        // Удаляем класс 'active' у других элементов, если они не равны текущему элементу и если текущий элемент не был активирован
                        if (otherItem !== item) {
                            otherItem.classList.remove('active');
                        }
                    });
                });
            });

            const radioButtons = document.querySelectorAll('input[type="radio"]');
            radioButtons.forEach(button => {
                button.addEventListener('change', function() {
                    const categoryId = this.value;
                    document.getElementById('loader').style.display = 'block';
                    document.querySelector('.overflow').style.display = 'block';
                    document.body.classList.toggle('fix');

                    fetch(`/catalog?category=${categoryId}`, {
                        method: 'GET', // Метод запроса
                        headers: { // Заголовки запроса, если необходимо
                            'Content-Type': 'application/json', // Тип контента (может быть другим)
                        },
                    })
                        .then(response => response.json()) // Парсинг JSON из ответа
                        .then(data => {
                            updateProductList(data);
                            document.getElementById('loader').style.display = 'none';
                            document.querySelector('.overflow').style.display = 'none';
                            document.body.classList.remove('fix');
                        })
                        .catch(error => console.error(error)); // Обработка ошибок
                });
            });

        });

        function updateProductList(products) {
            const firstBlock = document.querySelector('.first-block');
            const secondBlock = document.querySelector('.second-block');

            firstBlock.innerHTML = ''; // Очищаем содержимое блоков
            secondBlock.innerHTML = '';

            products.forEach((product, index) => {


                if (index < 4) {
                    const card = document.createElement('div');
                    card.classList.add('col-md-6');
                    card.innerHTML = `
                        @include('components.product-card', ['product' => $product, 'style' => 'catalog'])
                    `;
                    firstBlock.appendChild(card);
                } else {
                    const card = document.createElement('div');
                    card.classList.add('col-md-4');
                    card.innerHTML = `
                        @include('components.product-card', ['product' => $product, 'style' => 'catalog'])
                    `;
                    secondBlock.appendChild(card);
                }
            });
        }


    </script>
@endsection
