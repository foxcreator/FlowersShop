@extends('front.layouts.app')
@section('content')
    <section class="catalog">
        <div class="container">
            <h1>Каталог</h1>
            <div class="catalog__wrapper">
                <div class="overflow"></div>
                <div id="loader" class="spinner-border text-grey" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <button type="button" class="filter-mobile-btn">Фильтр @svg('filter')</button>
                <div class="row">
                    <div id="desktop-filter" class="catalog__filter col-lg-4 col-md-6">
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
                                            <div id="subcategories_{{ $category->id }}" class="subcategories">
                                                @foreach($category->subcategories as $subcategory)
                                                    <div class="form-check">

                                                        <input class="form-check-input subcategories-input" type="radio" name="subcategory"
                                                               value="{{ $subcategory->id }}"
                                                               id="categories_{{ $subcategory->id }}"
                                                               @if(request()->query('subcategory') == $subcategory->id) checked @endif

                                                        >
                                                        <label class="form-check-label" for="categories_{{ $subcategory->id }}">
                                                            {{ $subcategory->name }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
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
                                                       @if(request()->query('flower') == $flower->id) checked @endif
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
                                                       @if(request()->query('subject') == $subject->id) checked @endif
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
                    <div class="col-lg-8 col-md-6">
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

