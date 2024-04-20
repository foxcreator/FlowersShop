@if(!$comments)
    <div class="nothing">
        <p>Пока нет отзывов про этот товар</p>
        <p>Оставте свой отзыв и вы будете первым</p>
    </div>
@else
    @foreach($comments as $comment)
        <div class="comment">
            <div class="comment-header">
                <h4>{{ $comment->user_name }}</h4>
                <p>{{ \Carbon\Carbon::create($comment->created_at)->format('j. m. Y') }}</p>
            </div>
            <p>{{ $comment->content }}</p>
        </div>
    @endforeach
<div class="comments-paginate">
    @include('components.pagination', ['currentPage' => $currentPage, 'countPages' => $countPages])
</div>
@endif
