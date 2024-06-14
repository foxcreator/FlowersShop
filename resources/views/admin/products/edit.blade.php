@extends('admin.layouts.admin')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Редактирование {{ $product->title }}</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">

            <form action="{{ route('admin.products.update', $product) }}" method="POST" class="col-md-6" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="category_id">Категория</label>
                        <select class="form-control select2bs4" name="category_id" id="category_id" style="width: 100%;"
                                onchange="fetchSubcategories(this.value)"
                        >
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" @if($product->category_id == $category->id) selected @endif>{{ $category->title_uk }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="subcategory_id">Подкатегория</label>
                        <select class="form-control select2bs4 @error('subcategory') is-invalid @enderror"
                                id="subcategory_id"
                                name="subcategory_id"
                                style="width: 100%;"
                                data-selected-subcategory="{{ old('subcategory_id', $product->subcategory_id ?? '') }}"
                        >
                        </select>

                        @error('subcategory_id')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="flowers">Цветок (можно несколько)</label>
                        <select class="form-control select2bs4 @error('flowers') is-invalid @enderror"
                                id="flowers"
                                name="flowers[]"
                                multiple="multiple"
                                style="width: 100%;"
                        >

                        @foreach($flowers as $flower)
                                <option value="{{ $flower->id }}" {{ $product->flowers->contains($flower->id) ? 'selected' : '' }}>
                                    {{ $flower->name_uk }}
                                </option>
                            @endforeach
                        </select>

                        @error('flowers')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="subjects">Тематика (можно несколько)</label>
                        <select class="form-control select2bs4 @error('subjects') is-invalid @enderror"
                                id="subjects"
                                name="subjects[]"
                                multiple="multiple"
                                style="width: 100%;"
                        >
                            @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}" {{ $product->subjects?->contains($subject->id) ? 'selected' : '' }}>
                                    {{ $subject->name_uk }}
                                </option>
                            @endforeach
                        </select>

                        @error('subjects')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label for="article">Артикул</label>
                        <input type="text"
                               class="form-control @error('article') is-invalid @enderror"
                               id="article"
                               name="article"
                               value="{{ old('article', $product->article) }}"
                               placeholder="Введите артикул"
                               readonly
                               required
                        >
                        @error('article')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="title_uk">Наименование UA</label>
                        <input type="text"
                               class="form-control @error('title_uk') is-invalid @enderror"
                               id="title_uk"
                               name="title_uk"
                               value="{{ old('title_uk', $product->title_uk) }}"
                               placeholder="Введите наименование товара на украинском"
                               required
                        >
                        @error('title_uk')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="title_ru">Наименование RU</label>
                        <input type="text"
                               class="form-control @error('title_ru') is-invalid @enderror"
                               id="title_ru"
                               name="title_ru"
                               value="{{ old('title_ru', $product->title_ru) }}"
                               placeholder="Введите наименование товара на русском"
                        >
                        @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description_uk">Описание UA</label>
                        <textarea id="description_uk"
                                  name="description_uk"
                                  class="form-control @error('description_uk') is-invalid @enderror"
                                  rows="10"
                        >
                            {{ old('description_uk', $product->description_uk) }}
                        </textarea>
                        @error('description_uk')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description_ru">Описание RU</label>
                        <textarea id="description_ru"
                                  name="description_ru"
                                  class="form-control @error('description_ru') is-invalid @enderror"
                                  rows="10"
                        >
                            {{ old('description_ru', $product->description_ru) }}
                        </textarea>
                        @error('description_ru')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="opt_price">Оптовая цена</label>
                        <input type="text"
                               class="form-control @error('opt_price') is-invalid @enderror"
                               id="opt_price"
                               name="opt_price"
                               value="{{ old('opt_price', $product->opt_price) }}"
                               placeholder="Введите оптовую цену на товар"
                               required
                        >
                        @error('opt_price')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="price">Цена</label>
                        <input type="text"
                               class="form-control @error('price') is-invalid @enderror"
                               id="price"
                               name="price"
                               value="{{ old('price', $product->price) }}"
                               placeholder="Введите цену на товар"
                               required
                        >
                        @error('price')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="quantity">Количество на складе</label>
                        <input type="text"
                               class="form-control @error('quantity') is-invalid @enderror"
                               id="quantity"
                               name="quantity"
                               value="{{ old('quantity', $product->quantity) }}"
                               placeholder="Введите количество"
                               required
                        >
                        @error('quantity')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="thumbnail">Главное фото товара</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="thumbnail" name="thumbnail">
                                <label class="custom-file-label" for="thumbnail">Выберите файл</label>
                            </div>
                        </div>
                        @error('image')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div id="thumbnail-preview">
                        <img class="img-thumbnail" src="{{ $product->thumbnailUrl }}" alt="">
                    </div>

                    <div class="form-group mt-3">
                        <label for="">Бейджик товара</label>
                        <select class="form-control custom-select" name="badge" style="width: 100%;">
                            <option selected="selected" value="{{ null }}">------</option>
                            @foreach(\App\Models\Product::BADGES as $key => $badge)
                                <option value="{{ $key }}" @if($product->badge == $key) selected @endif>{{ $badge }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mt-4">
                        <input type="hidden" value="0" name="is_novelty">
                        <div class="icheck-success d-inline">
                            <input type="checkbox"
                                   id="checkboxPrimary1"
                                   name="is_novelty"
                                   value="{{ old('is_novelty', true) }}"
                                   @if($product->is_novelty) checked @endif
                                   @if($countNoveltyProduct >= 5) disabled @endif
                            >
                            <label for="checkboxPrimary1">Отображать товар в новинках на главной странице</label>
                        </div>
                        @if($countNoveltyProduct >= 5)
                            <p class="text-info">Количество новинок на главной странице равно 5, если хотите добавить новую, отключите уже сущесвующую</p>
                        @endif
                    </div>

                    <div class="form-group mt-4">
                        <input type="hidden" name="type" value="{{ \App\Models\Product::TYPE_FLOWER }}">
                        <div class="icheck-success d-inline">
                            <input type="checkbox"
                                   id="bouquet"
                                   name="type"
                                   value="{{ \App\Models\Product::TYPE_BOUQUET }}"
                                   @if($product->type === \App\Models\Product::TYPE_BOUQUET) checked @endif
                            >
                            <label for="bouquet">Букет</label>
                        </div>
                    </div>

                    <div class="form-group mt-4" id="product-selection" @if($product->type === \App\Models\Product::TYPE_BOUQUET) style="display: block" @else style="display: none" @endif>
                        <label for="products">Определите состав букета:</label>
                        <div id="products">
                            @if($product->products_quantities)
                                @foreach($product->products_quantities as $id => $quantity)
                                    <div class="product-item d-flex justify-content-between mt-2">
                                        <select class="form-control select2bs4"
                                                id="bouquet_flowers_{{ $id }}"
                                                name="products[{{ $id }}][id]"
                                                style="width: 75%;"
                                        >
                                            <option value="">Выберите цветок</option>
                                            @foreach($products as $prod)
                                                <option value="{{ $prod->id }}" @if($id === $prod->id) selected @endif>{{ $prod->title_uk }}</option>
                                            @endforeach
                                        </select>
                                        <input type="number" class="form-control" name="products[{{ $id }}][quantity]" min="1" value="{{ $quantity }}" placeholder="Количество" style="width: 20%">
                                    </div>
                                @endforeach
                            @else
                                <div class="product-item d-flex justify-content-between">
                                    <select class="form-control select2bs4"
                                            id="bouquet_flowers_0"
                                            name="products[0][id]"
                                            style="width: 75%;"
                                    >
                                        <option value="">Выберите цветок</option>
                                        @foreach($products as $prod)
                                            <option value="{{ $prod->id }}">{{ $prod->title_uk }}</option>
                                        @endforeach
                                    </select>
                                    <input type="number" class="form-control" name="products[0][quantity]" min="1" value="1" placeholder="Количество" style="width: 20%">
                                </div>
                            @endif
                        </div>
                        <button type="button" id="add-product" class="btn btn-xs btn-info mt-2">Добавить продукт</button>

                        <div class="form-group mt-4">
                            <input type="hidden" name="update_count" value="{{ false }}">
                            <div class="icheck-success d-inline">
                                <input type="checkbox"
                                       id="update_count"
                                       name="update_count"
                                       value="{{ true }}"
                                >
                                <label for="update_count">Списать цветы в букет</label>
                            </div>
                        </div>
                    </div>


                    <div class="card-footer d-flex justify-content-between gap-2">
                    <div class="col-md-6">
                        <a href="{{ route('admin.products.index') }}" class="btn btn-dark">Назад</a>
                    </div>
                    <div class="d-flex justify-content-end col-md-6 w-100">
                        <button type="submit" class="btn btn-success w-100">Сохранить</button>
                    </div>
                </div>
            </form>

        </div>
    </section>

    <script>
        document.getElementById('thumbnail').addEventListener('change', function(event) {
            var previewContainer = document.getElementById('thumbnail-preview');
            previewContainer.innerHTML = ''; // Очищаем превью перед добавлением нового изображения

            var file = event.target.files[0];
            var reader = new FileReader();

            reader.onload = function(e) {
                var img = document.createElement('img');
                img.src = e.target.result;
                img.classList.add('img-thumbnail', 'mb-4');
                previewContainer.appendChild(img);
            };

            reader.readAsDataURL(file);
        });

        function fetchSubcategories(categoryId, selectedSubcategoryId = null) {
            if (categoryId) {
                $('#subcategory_id').empty();
                $.ajax({
                    url: '/admin/categories/' + categoryId + '/subcategories',
                    type: 'GET',
                    success: function (subcategories) {
                        // $('#subcategory_id').empty().append('<option value="" selected>------</option>');

                        $.each(subcategories, function (key, subcategory) {
                            var isSelected = subcategory.id == selectedSubcategoryId ? ' selected' : '';
                            $('#subcategory_id').append('<option value="' + subcategory.id + '"' + isSelected + '>' + subcategory.name_ru + '</option>');
                        });
                    },
                    error: function () {
                        alert('Failed to fetch subcategories. Please try again.');
                    }
                });
            } else {
                $('#subcategory_id').empty().append('<option value="" selected>------</option>');
            }
        }

        $(document).ready(function() {
            var selectedCategoryId = $('#category_id').val();
            var selectedSubcategoryId = $('#subcategory_id').data('selected-subcategory');
            if (selectedCategoryId) {
                fetchSubcategories(selectedCategoryId, selectedSubcategoryId);
            }
        });


        document.addEventListener('DOMContentLoaded', function() {
            const bouquetCheckbox = document.getElementById('bouquet');
            const productSelection = document.getElementById('product-selection');
            const addProductButton = document.getElementById('add-product');
            const productsContainer = document.getElementById('products');
            let productCount = 1; // Начальный счетчик для продуктов

            // Показать/скрыть выбор продуктов при нажатии на чекбокс
            bouquetCheckbox.addEventListener('change', function() {
                if (this.checked) {
                    console.log(123)
                    productSelection.style.display = 'block';
                } else {
                    productSelection.style.display = 'none';
                }
            });

            // Добавление нового продукта
            addProductButton.addEventListener('click', function() {
                const newProduct = document.createElement('div');
                newProduct.className = 'product-item d-flex mt-2 justify-content-between';
                newProduct.innerHTML = `
            <select class="form-control select2bs4" id="bouquet_flowers" name="products[${productCount}][id]" style="width: 75%;">
                <option value="">Выберите цветок</option>
                @foreach($products as $product)
                <option value="{{ $product->id }}">{{ $product->title_uk }}</option>
                @endforeach
                </select>
                <input type="number" class="form-control" name="products[${productCount}][quantity]" min="1" placeholder="Количество" style="width: 20%">
`;
                productsContainer.appendChild(newProduct);
                $(newProduct).find('select').select2({
                    theme: 'bootstrap4'
                });
                productCount++;
            });
        });
    </script>
@endsection
