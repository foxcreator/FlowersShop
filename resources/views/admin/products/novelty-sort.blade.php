@extends('admin.layouts.admin')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">

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
                                <li class="nav-item"><a class="nav-link" href="#sort-novelty" data-toggle="tab">Редактирование изображений</a></li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane" id="sort-novelty">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-success btn-sm mb-5" id="uploadImageBtn">Загрузить изображения</button>
                                        <input type="file" id="imageInput" style="display: none;" accept="image/*" multiple>
                                    </div>
                                    <div id="sortable-images" class="d-flex row">
                                        @foreach($novelty as $product)
                                            <div class="image-container col-3" data-photo-id="{{ $product->id }}">
                                                <img class="img-thumbnail" src="{{ $product->thumbnailUrl }}" alt="" style="cursor: pointer; max-width: 100%">
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
