@extends('admin.layouts.admin')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Добавление нового товара</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <form action="{{ route('admin.products.store') }}" method="POST" class="col-md-6" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="category_id">Категория</label>
                        <select class="form-control select2bs4 @error('category') is-invalid @enderror"
                                id="category_id"
                                name="category_id"
                                style="width: 100%;"
                                onchange="fetchSubcategories(this.value)"
                        >
                            <option value="" selected>------</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->title_uk }}</option>
                            @endforeach
                        </select>

                        @error('category_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="subcategory_id">Подкатегория</label>
                        <select class="form-control select2bs4 @error('subcategory_id') is-invalid @enderror"
                                id="subcategory_id"
                                name="subcategory_id"
                                style="width: 100%;"
                        >
                            <option value="" selected>------</option>
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
                                <option value="{{ $flower->id }}">{{ $flower->name_uk }}</option>
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
                                <option value="{{ $subject->id }}">{{ $subject->name_uk }}</option>
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
                               value="{{ old('article', $article) }}"
                               placeholder="Введите артикул товара"
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
                               value="{{ old('title_uk') }}"
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
                               value="{{ old('title_ru') }}"
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
                        >{{ old('description_uk') ? trim(old('description_uk')) : '' }}</textarea>
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
                        >{{ old('description_ru') ? trim(old('description_ru')) : '' }}</textarea>
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
                               value="{{ old('opt_price') }}"
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
                        <label for="price">Розничная цена</label>
                        <input type="text"
                               class="form-control @error('price') is-invalid @enderror"
                               id="price"
                               name="price"
                               value="{{ old('price') }}"
                               placeholder="Введите розничную цену на товар"
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
                               value="{{ old('quantity') }}"
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
                                <input type="file"
                                       class="custom-file-input"
                                       id="thumbnail"
                                       name="thumbnail"
                                       accept="image/jpeg, image/png, image/jpg"
                                >
                                <label class="custom-file-label" for="thumbnail">Выберите файл</label>
                            </div>
                        </div>
                        @error('thumbnail')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div id="thumbnail-preview"></div>

                    <div class="form-group">
                        <label for="thumbnail">Дополнительные изображения</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file"
                                       class="custom-file-input"
                                       name="product_photos[]"
                                       id="product_photos"
                                       accept="image/jpeg, image/png, image/jpg"
                                       multiple
                                >
                                <label class="custom-file-label" for="thumbnail">Выберите файлы</label>
                            </div>
                        </div>
                        @error('product_photos')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="d-flex gap-3">
                        <div id="image-preview-container" class="row mb-2"></div>
                    </div>
                    <label for="">Бейджик товара</label>
                    <select class="form-control custom-select" name="badge" style="width: 100%;">
                        <option selected="selected" value="{{ null }}">------</option>
                        @foreach(\App\Models\Product::BADGES as $key => $badge)
                            <option value="{{ $key }}">{{ $badge }}</option>
                        @endforeach
                    </select>
                    <div class="form-group mt-4">
                        <div class="icheck-success d-inline">
                            <input type="checkbox"
                                   id="checkboxPrimary1"
                                   name="is_novelty"
                                   value="{{ old('is_novelty', true) }}"
                                   @if($countNoveltyProduct >= 8) disabled @endif
                            >
                            <label for="checkboxPrimary1">Отображать товар в новинках на главной странице</label>
                        </div>
                        @if($countNoveltyProduct >= 8)
                            <p class="text-info">Количество новинок на главной странице равно 8, если хотите добавить новую, отключите уже сущесвующую</p>
                        @endif
                    </div>
                    <div class="form-group mt-4">
                        <div class="icheck-success d-inline">
                            <input type="checkbox"
                                   id="is_active"
                                   name="is_active"
                                   value="{{ old('is_active', true) }}"
                            >
                            <label for="is_active">Активный товар</label>
                        </div>
                    </div>

                    <div class="form-group mt-4">
                        <div class="icheck-success d-inline">
                            <input type="radio" name="type" id="default" checked value="{{ \App\Models\Product::TYPE_DEFAULT }}">
                            <label for="default">Другое</label>
                        </div>
                        <div class="icheck-success d-inline">
                            <input type="radio" id="bouquet" name="type" value="{{ \App\Models\Product::TYPE_BOUQUET }}">
                            <label for="bouquet">Букет</label>
                        </div>
                        <div class="icheck-success d-inline">
                            <input type="radio" name="type" id="flower" value="{{ \App\Models\Product::TYPE_FLOWER }}">
                            <label for="flower">Цветок</label>
                        </div>
                    </div>

                    <div class="form-group mt-4" id="product-selection" style="display: none;">
                        <label for="products">Определите состав букета:</label>
                        <div id="products">
                            <div class="product-item d-flex justify-content-between">
                                <select class="form-control select2bs4"
                                        id="bouquet_flowers_0"
                                        name="products[0][id]"
                                        style="width: 75%;"
                                >
                                    <option value="">Выберите цветок</option>

                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->title_uk }}</option>
                                    @endforeach
                                </select>
                                <input type="number" class="form-control" name="products[0][quantity]" min="1" placeholder="Количество" style="width: 20%" value="1">
                            </div>
                        </div>
                        <button type="button" id="add-product" class="btn btn-xs btn-info mt-2">Добавить продукт</button>
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
        document.getElementById('product_photos').addEventListener('change', function(event) {
            var container = document.getElementById('image-preview-container');
            container.innerHTML = ''; // Очищаем содержимое контейнера перед добавлением новых изображений

            var files = event.target.files;
            for (var i = 0; i < files.length; i++) {
                var file = files[i];

                // Создаем элемент изображения для предпросмотра
                var img = document.createElement('img');
                img.src = URL.createObjectURL(file);
                img.classList.add('img-thumbnail');

                // Создаем кнопку удаления
                var deleteButton = document.createElement('button');
                deleteButton.innerHTML = 'Удалить';
                deleteButton.classList.add('btn', 'btn-danger', 'btn-sm', 'w-100', 'mt-1');
                deleteButton.addEventListener('click', function() {
                    this.parentNode.remove();
                });

                // Обертываем изображение и кнопку в блок div
                var imageContainer = document.createElement('div');
                imageContainer.classList.add('image-container', 'col-md-6', 'mb-4');
                imageContainer.appendChild(img);
                imageContainer.appendChild(deleteButton);

                // Добавляем блок с изображением в контейнер
                container.appendChild(imageContainer);
            }
        });

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


        function fetchSubcategories(categoryId) {
            if (categoryId) {
                $.ajax({
                    url: '/admin/categories/' + categoryId + '/subcategories',
                    type: 'GET',
                    success: function (subcategories) {
                        $('#subcategory_id').empty().append('<option value="" selected>------</option>');
                        $.each(subcategories, function (key, subcategory) {
                            $('#subcategory_id').append('<option value="' + subcategory.id + '">' + subcategory.name_ru + '</option>');
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


        document.addEventListener('DOMContentLoaded', function() {
            const bouquetCheckbox = document.getElementById('bouquet');
            const flowerCheckbox = document.getElementById('flower');
            const defaultCheckbox = document.getElementById('default');
            const productSelection = document.getElementById('product-selection');
            const addProductButton = document.getElementById('add-product');
            const productsContainer = document.getElementById('products');
            let productCount = 1; // Начальный счетчик для продуктов

            // Показать/скрыть выбор продуктов при нажатии на чекбокс
            bouquetCheckbox.addEventListener('change', function() {
                if (this.checked) {
                    productSelection.style.display = 'block';
                } else {
                    productSelection.style.display = 'none';
                }
            });

            flowerCheckbox.addEventListener('change', function() {
                if (this.checked) {
                    productSelection.style.display = 'none'; // Скрыть блок при выборе другого типа
                }
            });

            defaultCheckbox.addEventListener('change', function() {
                if (this.checked) {
                    productSelection.style.display = 'none'; // Скрыть блок при выборе другого типа
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
            <input type="number" class="form-control" name="products[${productCount}][quantity]" min="1" placeholder="Количество" style="width: 20%" value="1">
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
