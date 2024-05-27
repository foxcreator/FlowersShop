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
                                <li class="nav-item"><a class="nav-link" href="#sort-novelty" data-toggle="tab">Сортировка новинок на главной странице</a></li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content active">
                                <div class="tab-pane active" id="sort-novelty">
                                    <div id="sortable-novelty" class="d-flex row">
                                        @foreach($novelty as $product)
                                            <div class="image-container col-3" data-product-id="{{ $product->id }}">
                                                <img class="img-thumbnail" src="{{ $product->thumbnailUrl }}" alt="" style="cursor: pointer; max-width: 100%">
                                                <h5 style="cursor: pointer">{{ $product->title_ru }}</h5>
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
                $("#sortable-novelty").sortable({
                    cursor: "move",
                    distance: 50,
                    update: function(event, ui) {
                        // Получаем порядок изображений после изменения
                        var photoIds = $("#sortable-novelty .image-container").map(function() {
                            return $(this).data("product-id");
                        }).get();

                        console.log(photoIds);
                        $.ajax({
                            url: "{{ route('admin.products.sort-novelty.update') }}",
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
            });
        </script>
@endsection
