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
            @foreach($errors->all() as $error)
                {{ $error }}
            @endforeach
            <form action="{{ route('admin.products.store') }}" method="POST" class="col-md-6" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="category_id">Категория</label>
                        <select class="form-control select2bs4 @error('category') is-invalid @enderror"
                                id="category_id"
                                name="category_id"
                                style="width: 100%;"
                        >
                            <option value="" selected>------</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->title_ua }}</option>
                            @endforeach
                        </select>

                        @error('category_id')
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
                                <option value="{{ $flower->id }}">{{ $flower->name_ua }}</option>
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
                                <option value="{{ $subject->id }}">{{ $subject->name_ua }}</option>
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
                        <label for="title_ua">Наименование UA</label>
                        <input type="text"
                               class="form-control @error('title_ua') is-invalid @enderror"
                               id="title_ua"
                               name="title_ua"
                               value="{{ old('title_ua') }}"
                               placeholder="Введите наименование товара на украинском"
                               required
                        >
                        @error('title_ua')
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
                        <label for="description_ua">Описание UA</label>
                        <textarea id="description_ua"
                                  name="description_ua"
                                  class="form-control @error('description_ua') is-invalid @enderror"
                                  rows="10"
                                  required
                        >
                            {{ old('description_ua') }}
                        </textarea>
                        @error('description_ua')
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
                            {{ old('description_ru') }}
                        </textarea>
                        @error('description_ru')
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
                               value="{{ old('price') }}"
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
    </script>
@endsection
