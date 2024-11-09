<div class="row">
    @foreach ($posts as $post)
    <div class="col-md-4">
      <div class="card mb-4 box-shadow" style="min-height: 360px;">
        <img class="card-img-top" src="{{ $post->image }}" style="height: 225px; width: 100%; display: block;">
        <div class="card-body">
          <p class="card-text">{{ $post->title }}</p>
          <div class="text-end">
            <div class="btn-group">
              <a href="{{route('singlePost',$post->slug)}}" class="btn btn-outline-secondary">View</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endforeach
</div>
