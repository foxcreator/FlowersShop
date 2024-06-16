@php
if ($product->type === \App\Models\Product::TYPE_BOUQUET) {
    $productIds = array_keys($product->products_quantities);
    $products = App\Models\Product::whereIn('id', $productIds)->get();
}
@endphp

@extends('admin.layouts.admin')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 d-flex align-items-center">
                    <h1 class="m-0">{{ $product->title_uk }} @if($product->badge) <span class="text-success">({{ $product->badgeName }})</span> @endif</h1>
                    <a href="{{ route('front.product', $product->id) }}" class="ml-3" target="_blank">
                        <i class="fas fa-eye"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card w-100">
                        <div class="card-header p-2 d-flex justify-content-between w-100">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Основная информация</a></li>
                                <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Редактирование изображений</a></li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="activity">
                                    <div class="row">
                                        <div class="col-md-3 d-flex flex-column">
                                            <img src="{{ $product->thumbnailUrl }}" alt="">
                                            <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-info btn-sm mt-2">Редактировать</a>
                                            <button type="button"
                                                    class="btn btn-danger btn-sm mt-2"
                                                    data-toggle="modal"
                                                    data-target="#modal-default"
                                            >
                                                Удалить товар
                                            </button>
                                        </div>
                                        <div class="post col-md-9" style="border: none">
                                            <div class="d-flex justify-content-between mb-3" style="border-bottom: 1px solid #4a5568">
                                                <p>Артикул</p>
                                                <h5 class="text-gray-dark">{{ $product->article }}</h5>
                                            </div>
                                            <div class="d-flex justify-content-between mb-3" style="border-bottom: 1px solid #4a5568">
                                                <p>Наименование UA</p>
                                                <h5 class="text-gray-dark">{{ $product->title_uk }}</h5>
                                            </div>
                                            <div class="d-flex justify-content-between mb-3" style="border-bottom: 1px solid #4a5568">
                                                <p>Наименование RU</p>
                                                <h5 class="text-gray-dark">{{ $product->title_ru }}</h5>
                                            </div>
                                            <div class="d-flex justify-content-between mb-3" style="border-bottom: 1px solid #4a5568">
                                                <p>Цена на сайте</p>
                                                <h5 class="text-gray-dark">{{ $product->price }} грн</h5>
                                            </div>
                                            <div class="d-flex justify-content-between mb-3" style="border-bottom: 1px solid #4a5568">
                                                <p>Количество на складе</p>
                                                <h5 class="text-gray-dark">{{ $product->quantity }} шт</h5>
                                            </div>
                                            <div class="d-flex justify-content-between mb-3" style="border-bottom: 1px solid #4a5568">
                                                <p>Категория</p>
                                                <h5 class="text-gray-dark">{{ $product->category->title_uk }}</h5>
                                            </div>
                                        </div>
                                        @if($product->type === \App\Models\Product::TYPE_BOUQUET)
                                            <div class="col-12 mt-5">
                                                <h5>Состав букета</h5>
                                                @foreach($products as $prod)
                                                    <p><a href="{{ route('admin.products.show', $prod->id) }}">{{ $prod->title_uk }}</a> - <span>{{ $product->products_quantities[$prod->id] }} шт</span></p>
                                                @endforeach
                                            </div>
                                        @endif
                                        <div class="col-md-6 mt-5">
                                            <h5>Описание UA</h5>
                                            <p>{!! $product->description_uk !!}</p>
                                        </div>
                                        <div class="col-md-6 mt-5">
                                            <h5>Описание RU</h5>
                                            <p>{!! $product->description_ru !!}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="timeline">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-success btn-sm mb-5" id="uploadImageBtn">Загрузить изображения</button>
                                        <input type="file" id="imageInput" style="display: none;" accept="image/*" multiple>
                                    </div>
                                    <div id="sortable-images" class="d-flex row">
                                        @foreach($productPhotos as $photo)
                                            <div class="image-container col-3" data-photo-id="{{ $photo->id }}">
                                                <img class="img-thumbnail" src="{{ $photo->fileNameUrl }}" alt="" style="cursor: pointer; max-width: 100%">
                                                <i class="fas fa-times icon-close text-danger delete-icon" id="delete"></i>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal-default">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body text-center">
                        <h5>Удалить безвозвратно товар - {{ $product->title_uk }}?</h5>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-success btn-sm" data-dismiss="modal">Вернуться</button>
                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Удалить навсегда</button>
                        </form>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

    <script>
        $(document).ready(function() {
            // Инициализируем сортировку изображений
            $("#sortable-images").sortable({
                cursor: "move",
                distance: 50,
                update: function(event, ui) {
                    // Получаем порядок изображений после изменения
                    var photoIds = $("#sortable-images .image-container").map(function() {
                        return $(this).data("photo-id");
                    }).get();

                    console.log(photoIds);
                    $.ajax({
                        url: "{{ route('admin.sort.photo') }}",
                        type: "POST",
                        headers: {
                            'X-CSRF-Token': "{{ csrf_token() }}"
                        },
                        data: { photoIds: photoIds },
                        success: function(response) {
                            console.log(response);
                            console.log("Порядок изображений успешно обновлен.");
                        },
                        error: function(xhr, status, error) {
                            console.log(error);
                            console.error("Произошла ошибка при обновлении порядка изображений:", error);
                        }
                    });
                }
            });

            $(".delete-icon").click(function () {
                // Находим родительский контейнер изображения
                var container = $(this).closest(".image-container");
                // Получаем идентификатор изображения
                var photoId = container.data("photo-id");

                console.log(photoId);
                // Отправляем AJAX запрос на сервер для удаления изображения
                $.ajax({
                    url: "{{ route('admin.delete.photo') }}",
                    type: "POST",
                    headers: {
                        'X-CSRF-Token': "{{ csrf_token() }}"
                    },
                    data: { photoId: photoId },
                    success: function(response) {
                        console.log("Изображение успешно удалено.");
                        // Удаляем контейнер изображения из DOM
                        container.remove();
                    },
                    error: function(xhr, status, error) {
                        console.error("Произошла ошибка при удалении изображения:", error);
                    }
                });
            })
        });

        $(document).ready(function() {
            $('#uploadImageBtn').on('click', function() {
                $('#imageInput').click(); // Симулируем клик по скрытому input для выбора файлов
            });

            $('#imageInput').on('change', function() {
                var formData = new FormData();
                var files = $(this)[0].files;

                for (var i = 0; i < files.length; i++) {
                    formData.append('images[]', files[i]);
                }

                formData.append('product', {{ $product->id }});

                console.log(formData);
                $.ajax({
                    url: "{{ route('admin.upload.photo') }}",
                    type: 'POST',
                    headers: {
                        'X-CSRF-Token': "{{ csrf_token() }}"
                    },
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.error('Ошибка при загрузке изображений:', error);
                    }
                });
            });
        });
    </script>
@endsection

