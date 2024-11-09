<table class="table table-bordered table-striped table-sm">
    <thead>
        <tr>
           <th>#Sl</th>
           <th>Title</th>
           <th>Excerpt</th>
           <th>Image</th>
           <th>Status</th>
           <th>Action</th>
        </tr>
    </thead>
    <tbody>
     <?php $i = (($posts->currentPage() - 1) * $posts->perPage() + 1); ?>
     @forelse ($posts as $key => $post)
        <tr>
             <td>{{$i++}}</td>
             <td>{{Str::limit($post->title, 20, '...')}}</td>
             <td>{{Str::limit($post->excerpt, 20, '...')}}</td>
             <td>  <img src="{{ $post->getImageUrl() }}" alt="{{$post->title}}" width="50" height="50"/></td>
             <td>
                 @if($post->active == 1)
                 <button class="badge border-0 badge-primary postStatus" data-url="{{route("admin.posts.status",['post'=>$post])}}" >
                     Active
                 </button>
                 @else
                 <button class="badge border-0 badge-danger postStatus" data-url="{{route("admin.posts.status",['post'=>$post])}}" >
                     Inactive
                 </button>
                 @endif
             </td>

             <td>
                 <a class="btn btn-warning btn-sm" href="{{ route('admin.posts.edit',$post)}}">Edit</a>
                 <button class="btn btn-danger btn-sm postDelete"
                 data-url ="{{ route('admin.posts.destroy', $post) }}"
                >Delete</button>
             </td>
        </tr>
     @empty
        <tr>
            <td colspan="6" class="text-danger h5 text-center">No Post Found</td>
        </tr>
     @endforelse
    </tbody>
</table>
