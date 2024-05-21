@if(!$comments->count())
    <div class="nothing">
        <p>{{ __('product_show.not_reviews') }}</p>
        <p>{{ __('product_show.make_first_review') }}</p>
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
