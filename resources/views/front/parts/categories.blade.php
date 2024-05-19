@php
    $categories = \App\Models\Category::where('is_show_on_homepage', true)->get();
@endphp
<div class="container mt-200">
    <section class="categories">
        <div class="categories__header">
            <h1>{{ __('homepage.categories') }}</h1>
        </div>

        <div class="categories__cards row">
            @foreach($categories as $category)
                <div class="categories__card col-6">
                    <div class="categories__card-img">
                        <a href="{{ route('front.catalog', ['category' => $category->id]) }}">
                            <img class="category-img" src="{{ asset($category->thumbnailUrl) }}" alt="">
                        </a>
                    </div>
                    <a href="{{ route('front.catalog', ['category' => $category->id]) }}">
                        <div class="categories__info">
                            <p class="categories__name">{{ $category->title }}</p>
                        </div>
                    </a>
                </div>
            @endforeach
            <div class="categories__link-block col-6">
                <a href="{{ route('front.catalog') }}" class="categories__link">
                    <span>{{ __('homepage.categories') }}</span>
                    @svg('arrow-circle-right')
                </a>
            </div>
        </div>
    </section>
</div>
<script>
    // Получаем все элементы изображений с классом square-img
    var images = document.querySelectorAll('.category-img');

    // Перебираем все изображения и применяем необходимые изменения
    images.forEach(function(img) {
        // После загрузки изображения выполняем следующий код
        img.onload = function() {
            // Получаем ширину изображения
            var width = img.width;

            // Устанавливаем высоту изображения равной его ширине
            img.style.height = width + 'px';
        };
    });
</script>
