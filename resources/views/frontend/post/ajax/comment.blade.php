<div class="comment-item px-3 py-2 border-bottom bg-light" id="comment-{{ $comment->id }}">
    <div class="d-flex justify-content-between mb-2">
        <div class="d-flex">
            <img src="{{ url('/img/avatar.jpg')}}" class="w3-circle" width="40" height="40" alt="">
            &nbsp;
            <p class="mt-1">{{ $comment->body }}</p>
        </div>
        <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
    </div>
</div>
