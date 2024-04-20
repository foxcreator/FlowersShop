@extends('admin.layouts.admin')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ $banner->title_uk }}</h1>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Основная информация</a></li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="activity">
                                    <div class="row">
                                        <div class="col-md-5 d-flex flex-column">
                                            <img src="{{ $banner->imageUrl }}" alt="">
                                            <a href="{{ route('admin.banners.edit', $banner->id) }}" class="btn btn-info btn-sm mt-2">Редактировать</a>
                                            <button type="button"
                                                    class="btn btn-danger btn-sm mt-2"
                                                    data-toggle="modal"
                                                    data-target="#delete-banner"
                                            >
                                                Удалить постер
                                            </button>
                                        </div>
                                        <div class="post col-md-7" style="border: none">
                                            <div class="d-flex justify-content-between mb-3" style="border-bottom: 1px solid #4a5568">
                                                <p>Наименование UA</p>
                                                <h5 class="text-gray-dark">{{ $banner->title_uk }}</h5>
                                            </div>
                                            <div class="d-flex justify-content-between mb-3" style="border-bottom: 1px solid #4a5568">
                                                <p>Наименование RU</p>
                                                <h5 class="text-gray-dark">{{ $banner->title_ru }}</h5>
                                            </div>
                                            <div class="d-flex justify-content-between mb-3" style="border-bottom: 1px solid #4a5568">
                                                <p>Текст кнопки UA</p>
                                                <h5 class="text-gray-dark">{{ $banner->btn_text_uk }}</h5>
                                            </div>
                                            <div class="d-flex justify-content-between mb-3" style="border-bottom: 1px solid #4a5568">
                                                <p>Текст кнопки RU</p>
                                                <h5 class="text-gray-dark">{{ $banner->btn_text_ru }}</h5>
                                            </div>
                                            <div class="d-flex justify-content-between mb-3" style="border-bottom: 1px solid #4a5568">
                                                <p>Ссылка</p>
                                                <h5 class="text-gray-dark">
                                                    <a target="_blank" class="list-link" href="
                                                        @if($banner->product_id)
                                                            {{ route('admin.products.show', $banner->product_id) }}
                                                        @else
                                                            {{ $banner->link }}
                                                        @endif"
                                                    >
                                                        Перейти
                                                    </a>
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="delete-banner">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body text-center">
                        <h5>Удалить постер - {{ $banner->title_uk }}?</h5>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-success btn-sm" data-dismiss="modal">Вернуться</button>
                        <form action="{{ route('admin.banners.destroy', $banner->id) }}" method="POST">
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
@endsection

