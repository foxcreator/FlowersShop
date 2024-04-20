@php
    $categories = \App\Models\Category::where('is_show_on_homepage', true)->get();
@endphp
<div class="container mt-200">
    <section class="categories">
        <div class="categories__header">
            <h1>Категории</h1>
        </div>

        <div class="categories__cards">
            @foreach($categories as $category)
                <div class="categories__card">
                    <div class="categories__card-img">
                        <a href="{{ route('admin.products.index') }}">
                            <img src="{{ asset($category->thumbnailUrl) }}" alt="">
                        </a>
                    </div>
                    <a href="{{ route('admin.products.index') }}">
                        <div class="categories__info">
                            <p class="categories__name">{{ $category->title_ua }}</p>
                        </div>
                    </a>
                </div>
            @endforeach
            <div class="categories__link-block">
                <a href="#" class="categories__link">
                    <span>Каталог</span>
                    @svg('arrow-circle-right')
                </a>
            </div>
        </div>
    </section>
</div>
