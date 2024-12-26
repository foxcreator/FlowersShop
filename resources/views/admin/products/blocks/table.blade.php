<table class="table table-hover text-nowrap">
    <thead>
    <tr>
        <th>Изображение</th>
        <th>Артикул</th>
        <th>Название UA</th>
        <th>Тип</th>
        <th>Цена</th>
        <th>Кол-во</th>
        <th>Бейдж</th>
        <th>Новинка</th>
        <th>Активный</th>
        <th class="text-right">Действия</th>
    </tr>
    </thead>
    <tbody>
    @foreach($products as $product)
        <tr>
            <td class="table-image" style="max-height: 20px">
                <img class="img-thumbnail m-height" src="{{ $product->thumbnailUrl }}" alt="">
            </td>
            <td>{{ $product->article }}</td>
            <td class="custom-text-overflow">{{ $product->title_uk }}</td>
            <td>{{ $product->typeName }}</td>
            <td>{{ $product->price }}</td>
            <td>{{ $product->quantity }}</td>
            <td>{{ $product->badgeName }}</td>
            <td class="text-center">
                @if($product->is_novelty)
                    <i class="fas fa-check-square text-success"></i>
                @else
                    <i class="fas fa-window-close text-danger"></i>
                @endif
            </td>
            <td class="text-center">
                @if($product->is_active)
                    <i class="fas fa-check-square text-success"></i>
                @else
                    <i class="fas fa-window-close text-danger"></i>
                @endif
            </td>


            <td class="text-right">
                <a href="{{ route('admin.products.show', $product->id) }}" class="btn btn-secondary btn-xs">Информация</a>
                <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-info btn-xs">Редактировать</a>
            </td>
        </tr>
    @endforeach

    </tbody>
</table>
