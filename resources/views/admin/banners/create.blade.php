@extends('admin.layouts.admin')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Добавление категории</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <form action="{{ route('admin.banners.store') }}" method="POST" class="col-md-6" enctype="multipart/form-data">
                @csrf
                {{ $errors }}
                <div class="card-body">
                    <p>* - обязательные поля</p>
                    <div class="form-group">
                        <label for="product_id">Продукт</label>
                        <select class="form-control select2bs4 @error('product_id') is-invalid @enderror"
                                id="product_id"
                                name="product_id"
                                style="width: 100%;"
                        >
                            <option value="{{ null }}" selected>------</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}">{{ $product->title_ua }}</option>
                            @endforeach
                        </select>

                        @error('product_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="title_ua">Наименование UA*</label>
                        <input type="text"
                               class="form-control @error('title_ua') is-invalid @enderror"
                               id="title_ua"
                               name="title_ua"
                               value="{{ old('title_ua') }}"
                               placeholder="Введите наименование"
                               required
                        >
                        @error('title_ua')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="title_ru">Наименование RU*</label>
                        <input type="text"
                               class="form-control @error('title_ru') is-invalid @enderror"
                               id="title_ru"
                               name="title_ru"
                               value="{{ old('title_ru') }}"
                               placeholder="Введите наименование"
                        >
                        @error('title_ru')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="image">Изображение*</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file"
                                       class="custom-file-input @error('image') is-invalid @enderror"
                                       id="image"
                                       name="image"
                                       accept="image/jpeg, image/png, image/jpg"
                                >
                                <label class="custom-file-label" for="image">Выберите файл</label>
                            </div>
                        </div>
                        @error('image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div id="image-preview"></div>

                    <div class="form-group">
                        <label for="btn_text_ua">Текст кнопки UA</label>
                        <input type="text"
                               class="form-control @error('btn_text_ua') is-invalid @enderror"
                               id="btn_text_ua"
                               name="btn_text_ua"
                               value="{{ old('btn_text_ua') }}"
                               placeholder="Введите наименование"
                        >
                        @error('btn_text_ua')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="btn_text_ru">Текст кнопки RU</label>
                        <input type="text"
                               class="form-control @error('btn_text_ru') is-invalid @enderror"
                               id="btn_text_ru"
                               name="btn_text_ru"
                               value="{{ old('btn_text_ru') }}"
                               placeholder="Введите наименование"
                        >
                        @error('btn_text_ru')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="link">Ссылка на страницу</label>
                        <input type="text"
                               class="form-control @error('link') is-invalid @enderror"
                               id="link"
                               name="link"
                               value="{{ old('link') }}"
                               placeholder="products/100"
                        >
                        @error('link')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="icheck-success d-inline">
                        <input type="checkbox"
                               id="is_active"
                               name="is_active"
                               value="1"
                               checked
                        >
                        <label for="is_active">Отображать постер на главной странице</label>
                    </div>
                </div>

                <div class="card-footer d-flex justify-content-between gap-2">
                    <div class="col-md-6">
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-dark">Назад</a>
                    </div>
                    <div class="d-flex justify-content-end col-md-6 w-100">
                        <button type="submit" class="btn btn-success w-100">Сохранить</button>
                    </div>
                </div>
            </form>

        </div>
    </section>

    <script>
        document.getElementById('image').addEventListener('change', function(event) {
            var previewContainer = document.getElementById('image-preview');
            previewContainer.innerHTML = '';

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
