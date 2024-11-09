<table class="table table-bordered table-striped table-sm">
    <thead>
        <tr>
           <th>#Sl</th>
           <th>Title</th>
           <th>Image</th>
           <th>Status</th>
           <th>Action</th>
        </tr>
    </thead>
    <tbody>
     <?php $i = (($categories->currentPage() - 1) * $categories->perPage() + 1); ?>
     @forelse ($categories as $key => $category)
        <tr>
             <td>{{$i++}}</td>
             <td>{{Str::limit($category->name, 20, '...')}}</td>
             <td>  <img src="{{ $category->getImageUrl() }}" alt="{{$category->title}}" width="50" height="50"/></td>
             <td>
                 @if($category->active == 1)
                 <button class="badge border-0 badge-primary categoryStatus" data-url="{{route("admin.categories.status",['category'=>$category])}}" >
                     Active
                 </button>
                 @else
                 <button class="badge border-0 badge-danger categoryStatus" data-url="{{route("admin.categories.status",['category'=>$category])}}" >
                     Inactive
                 </button>
                 @endif
             </td>

             <td>
                 <a class="btn btn-warning btn-sm" href="{{ route('admin.categories.edit',$category)}}">Edit</a>
                 <button class="btn btn-danger btn-sm categoryDelete"
                 data-url ="{{ route('admin.categories.destroy', $category) }}"
                >Delete</button>
             </td>
        </tr>
     @empty
        <tr>
            <td colspan="5" class="text-danger h5 text-center">No Post Found</td>
        </tr>
     @endforelse
    </tbody>
</table>
