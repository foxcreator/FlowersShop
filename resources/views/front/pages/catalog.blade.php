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
                                    <p><span></span>{{ __('homepage.categories') }}</p>
                                    @svg('circle-arrow')
                                </div>
                                <div class="accordion-content">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="category" value="all"
                                               id="categories_all" checked>
                                        <label class="form-check-label" for="categories_all">
                                            {{ __('homepage.all') }}
                                        </label>
                                    </div>
                                    @foreach($categories as $category)
                                        <div class="form-check">

                                            <input class="form-check-input" type="radio" name="category"
                                                   value="{{ $category->id }}"
                                                   id="categories_{{ $category->id }}"
                                                   @if(request()->query('category') == $category->id) checked @endif

                                            >
                                            <label class="form-check-label" for="categories_{{ $category->id }}">
                                                {{ $category->title }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="accordion-item">
                                <div class="accordion-item">
                                    <div class="accordion-header">
                                        <p><span></span>{{ __('homepage.flower') }}</p>
                                        @svg('circle-arrow')
                                    </div>
                                    <div class="accordion-content">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="flower" value="all"
                                                   id="flowers_all" checked>
                                            <label class="form-check-label" for="flowers_all">
                                                {{ __('homepage.all') }}
                                            </label>
                                        </div>
                                        @foreach($flowers as $flower)
                                            <div class="form-check">
                                                <input class="form-check-input"
                                                       type="radio"
                                                       name="flower"
                                                       value="{{$flower->id}}"
                                                       id="flowers_{{ $flower->id }}"
                                                       @if(request()->query('flower') === $flower->id) checked @endif
                                                >
                                                <label class="form-check-label"
                                                       for="flowers_{{ $flower->id }}">
                                                    {{ $flower->name }}
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
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="subject" value="all"
                                                   id="subjects_all" checked>
                                            <label class="form-check-label" for="subjects_all">
                                                {{ __('homepage.all') }}
                                            </label>
                                        </div>
                                        @foreach($subjects as $subject)
                                            <div class="form-check">
                                                <input class="form-check-input"
                                                       type="radio"
                                                       name="subject"
                                                       value="{{$subject->id}}"
                                                       id="subjects_{{ $subject->id }}"
                                                       @if(request()->query('subject') === $subject->id) checked @endif
                                                >
                                                <label class="form-check-label"
                                                       for="subjects_{{ $subject->id }}">
                                                    {{ $subject->name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="price">
                                <p><span></span>{{ __('homepage.price') }}</p>
                                @svg('circle-arrow')
                            </div>
                            <div id="slider"></div>
                            <div class="d-flex justify-content-between mt-2 w-100">
                                <p>₴<span id="minPrice"></span></p>
                                <p>₴<span id="maxPrice"></span></p>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-8">
                        <div class="row first-block">
                            @include('front.pages.catalog.parts.first-products-block', ['products' => $products])
                        </div>
                    </div>
                </div>
                <div class="row second-block">
                    @include('front.pages.catalog.parts.second-products-block', ['products' => $products])

                </div>
                <div class="catalog__paginate">
                    @include('components.pagination', ['currentPage' => $currentPage, 'countPages' => $countPages])
                </div>
            </div>
        </div>
    </section>
@endsection
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var accordionHeaders = document.querySelectorAll('.accordion-item > .accordion-header');

        accordionHeaders.forEach(function (header) {
            header.addEventListener('click', function () {
                var item = this.parentNode;
                item.classList.toggle('active');

                accordionHeaders.forEach(function (otherHeader) {
                    var otherItem = otherHeader.parentNode;
                    if (otherItem !== item) {
                        otherItem.classList.remove('active');
                    }
                });
            });
        });

        const categories = document.querySelectorAll('input[name="category"]');
        const flowers = document.querySelectorAll('input[name="flower"]');
        const subjects = document.querySelectorAll('input[name="subject"]');
        const minPrice = document.getElementById('minPrice');
        const maxPrice = document.getElementById('maxPrice');
        const slider = document.getElementById('slider');

        slider.noUiSlider.on('update', function (values, handle) {
            minPrice.textContent = parseInt(values[0]);
            maxPrice.textContent = parseInt(values[1]);
        });

        // Слушатель события изменения цены
        slider.noUiSlider.on('change', function (values, handle) {
            const categoryId = getSelectedCategory('category');
            const flowerId = getSelectedCategory('flower');
            const subjectId = getSelectedCategory('subject');
            const minPriceValue = minPrice.textContent;
            const maxPriceValue = maxPrice.textContent;

            fetchProducts(categoryId, minPriceValue, maxPriceValue, flowerId, subjectId);
        });

        categories.forEach(button => {
            button.addEventListener('change', function () {
                const categoryId = this.value;
                const flowerId = getSelectedCategory('flower');
                const subjectId = getSelectedCategory('subject');
                const minPriceValue = minPrice.textContent;
                const maxPriceValue = maxPrice.textContent;

                fetchProducts(categoryId, minPriceValue, maxPriceValue, flowerId, subjectId);
            });
        });

        flowers.forEach(button => {
            button.addEventListener('change', function () {
                const flowerId = this.value;
                const categoryId = getSelectedCategory('category');
                const subjectId = getSelectedCategory('subject');
                const minPriceValue = minPrice.textContent;
                const maxPriceValue = maxPrice.textContent;

                fetchProducts(categoryId, minPriceValue, maxPriceValue, flowerId, subjectId);
            });
        });

        subjects.forEach(button => {
            button.addEventListener('change', function () {
                const categoryId = getSelectedCategory('category');
                const flowerId = getSelectedCategory('flower');
                const subjectId = this.value;
                const minPriceValue = minPrice.textContent;
                const maxPriceValue = maxPrice.textContent;

                fetchProducts(categoryId, minPriceValue, maxPriceValue, flowerId, subjectId);
            });
        });


        document.addEventListener('click', function(event) {
            if (event.target.classList.contains('custom-pagination__page-link')) {
                event.preventDefault();
                const page = event.target.textContent;
                const categoryId = getSelectedCategory('category');
                const flowerId = getSelectedCategory('flower');
                const subjectId = getSelectedCategory('subject');
                const minPrice = document.getElementById('minPrice').textContent;
                const maxPrice = document.getElementById('maxPrice').textContent;
                fetchProducts(categoryId, minPrice, maxPrice, flowerId, subjectId, page);
            }
        });

    });

    function fetchProducts(categoryId, minPrice, maxPrice, flowerId, subjectId, page = 1) {
        document.getElementById('loader').style.display = 'block';
        document.querySelector('.overflow').style.display = 'block';
        document.body.classList.toggle('fix');

        let url = `/catalog?page=${page}&category=${categoryId}&flower=${flowerId}&subject=${subjectId}`;

        if (minPrice && maxPrice) {
            url += `&min-price=${minPrice}&max-price=${maxPrice}`;
        }

        fetch(url, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
        })
            .then(response => response.json())
            .then(data => {
                updateProductList(data);
                document.getElementById('loader').style.display = 'none';
                document.querySelector('.overflow').style.display = 'none';
                document.body.classList.remove('fix');
            })
            .catch(error => console.error(error));
    }

    function updateProductList(data) {
        const firstBlock = document.querySelector('.first-block');
        const secondBlock = document.querySelector('.second-block');
        const paginate = document.querySelector('.catalog__paginate');

        firstBlock.innerHTML = data.html.first;
        secondBlock.innerHTML = data.html.second;
        paginate.innerHTML = data.html.paginate;
    }

    function getSelectedCategory(filter) {
        const selectedFilter = document.querySelector(`input[name="${filter}"]:checked`);
        return selectedFilter ? selectedFilter.value : '';
    }


</script>
