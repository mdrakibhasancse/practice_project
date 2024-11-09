@foreach ($post->paginatedComments as $comment)
    @include('frontend.post.ajax.comment', ['comment' => $comment])
@endforeach
