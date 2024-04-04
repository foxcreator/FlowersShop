@extends('admin.layouts.admin')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Редактирование категории - {{ $category->title_ua }}</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">

            <form action="{{ route('admin.categories.store') }}" method="POST" class="col-md-6" enctype="multipart/form-data">
                @csrf
                <div class="card-body">

                    <div class="form-group">
                        <label for="title_ua">Наименование UA</label>
                        <input type="text"
                               class="form-control @error('title_ua') is-invalid @enderror"
                               id="title_ua"
                               name="title_ua"
                               value="{{ old('title_ua', $category->title_ua) }}"
                               placeholder="Введите наименование категории на украинском"
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
                               value="{{ old('title_ru', $category->title_ru) }}"
                               placeholder="Введите наименование категории на русском"
                        >
                        @error('title_ru')
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
                            {{ old('description_ua', $category->description_ua) }}
                        </textarea>
                        @error('description')
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
                            {{ old('description_ru', $category->description_ua) }}
                        </textarea>
                        @error('description_ru')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="thumbnail">Изображение</label>
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
                        @error('image')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div id="thumbnail-preview">
                        <img src="{{ $category->thumbnailUrl }}" alt="">
                    </div>

                    <div class="form-group mt-4">
                        <div class="icheck-success d-inline">
                            <input type="checkbox"
                                   id="checkboxPrimary1"
                                   name="is_show_on_homepage"
                                   value="{{ old('is_show_on_homepage', $category->is_show_on_homepage) }}"
                                   @if($countShowCategory >= 3) disabled @endif
                            >
                            <label for="checkboxPrimary1">Отображать категорию на главной странице</label>
                        </div>
                        @if($countShowCategory >= 3)
                            <p class="text-info">Количество категорий на главной странице равно 3, если хотите добавить новую, отключите уже сущесвующую</p>
                        @endif
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
        document.getElementById('thumbnail').addEventListener('change', function(event) {
            var previewContainer = document.getElementById('thumbnail-preview');
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
