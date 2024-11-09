<table class="table table-bordered table-striped table-sm">
    <thead>
        <tr>
           <th>#Sl</th>
           <th>Title</th>
           <th>Post Name</th>
           <th>vedio</th>
           <th>Status</th>
           <th>Action</th>
        </tr>
    </thead>
    <tbody>
     <?php $i = (($vedios->currentPage() - 1) * $vedios->perPage() + 1); ?>
     @forelse ($vedios as $key => $vedio)
        <tr>
             <td>{{$i++}}</td>
             <td>{{Str::limit($vedio->title, 20, '...')}}</td>
             <td>{{ Str::limit($vedio->post->title, 20, '...')}}</td>
             <td>
                <video width="150" controls>
                    <source src="{{ Storage::url($vedio->vedio_path) }}">
                </video>
             </td>
             <td>
                 @if($vedio->active == 1)
                 <button class="badge border-0 badge-primary vedioStatus" data-url="{{route("admin.vedios.status",['vedio'=>$vedio])}}" >
                     Active
                 </button>
                 @else
                 <button class="badge border-0 badge-danger vedioStatus" data-url="{{route("admin.vedios.status",['vedio'=>$vedio])}}" >
                     Inactive
                 </button>
                 @endif
             </td>

             <td>
                 <a class="btn btn-warning btn-sm" href="{{ route('admin.vedios.edit',$vedio)}}">Edit</a>
                 <button class="btn btn-danger btn-sm vedioDelete"
                 data-url ="{{ route('admin.vedios.destroy', $vedio) }}"
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
