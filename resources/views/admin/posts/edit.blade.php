@extends('admin.layouts.app')
@section('content')
<div class="row">
    <div class="col-md-8 offset-2">
        <div class="card">
            <div class="card-header py-1">
                <div class="card-title">
                  Post Edit
                </div>
                <div class="card-tools">
                   <a href="{{ route('admin.posts.index')}}" class="btn btn-primary btn-sm">Back</a>
                </div>
            </div>
            <form action="{{ route('admin.posts.update',$post)}}" method="POST" enctype="multipart/form-data">
               @csrf
               @method("PUT")
                <div class="card-body py-1">
                    <div class="card-body">
                      <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" name="title" id="title" value="{{old('title', $post->title)}}" placeholder="Enter title"
                        onkeyup="makeSlug(this.value)">
                        @error('title')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>

                      <div class="form-group">
                        <label for="slug">Slug</label>
                        <input type="text" class="form-control" name="slug" id="slug" value="{{old('slug', $post->slug)}}" placeholder="Enter slug">
                      </div>

                      <div class="form-group">
                        <label for="excerpt">Excerpt</label>
                        <textarea name="excerpt" id="excerpt" placeholder="Enter excerpt" class="form-control" rows="2">{{old('excerpt', $post->excerpt)}}</textarea>
                      </div>


                      <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="summernote" class="form-control" rows="5"
                         placeholder="Enter description">{{old('description', $post->description)}}</textarea>
                      </div>

                      <div class="form-group">
                        <label for="exampleInputFile">Image Name</label>
                        <div class="input-group">
                          <div class="">
                            <input type="file" id="image" name="image">
                            <label for="image"></label>
                          </div>
                          <img src="{{ url('storage/posts/'.$post->image) }}" alt="{{$post->title}}" width="50" height="50"/>
                        </div>
                        @error('image')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="active" name="active" {{$post->active == 1 ? 'checked' : ''}}>
                        <label class="form-check-label" for="active">Active</label>
                      </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-sm float-right">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('js')
<script>
    function makeSlug(val) {
        let str = val;
        let output = str.replace(/\s+/g, '-').toLowerCase();
        $('#slug').val(output);
    }
</script>
@endpush
