@php
    $categories = \App\Models\Category::where('is_show_on_homepage', true)->get();
@endphp
<div class="container mt-200">
    <section class="categories">
        <div class="categories__header">
            <h1>{{ __('homepage.popular_categories') }}</h1>
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
                    <span>{{ __('homepage.all_categories') }}</span>
                    @svg('arrow-circle-right')
                </a>
            </div>
        </div>
    </section>
</div>
<script>
    var images = document.querySelectorAll('.category-img');

    images.forEach(function(img) {
        img.onload = function() {
            var width = img.width;
            img.style.height = width + 'px';
        };
    });
</script>
