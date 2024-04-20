<table class="table table-hover text-nowrap">
    <thead>
    <tr>
        <th>Изображение</th>
        <th>Артикул</th>
        <th>Название UA</th>
        <th>Название RU</th>
        <th>Цена</th>
        <th>Количество</th>
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
            <td class="custom-text-overflow">{{ $product->title_ua }}</td>
            <td class="custom-text-overflow">{{ $product->title_ru }}</td>
            <td>{{ $product->price }}</td>
            <td>{{ $product->quantity }}</td>

            <td class="text-right">
                <a href="{{ route('admin.products.show', $product->id) }}" class="btn btn-secondary btn-xs">Информация</a>
                <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-info btn-xs">Редактировать</a>
            </td>
        </tr>
    @endforeach

    </tbody>
</table>
