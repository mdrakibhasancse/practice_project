@extends('admin.layouts.app')
@section('content')
<div class="row">
    <div class="col-md-8 offset-2">
        <div class="card">
            <div class="card-header py-1">
                <div class="card-title">
                    Vedio Create
                </div>
                <div class="card-tools">
                   <a href="{{ route('admin.vedios.index')}}" class="btn btn-primary btn-sm">Back</a>
                </div>
            </div>
            <form action="{{ route('admin.vedios.store')}}" method="POST" enctype="multipart/form-data">
               @csrf

                <div class="card-body py-1">
                    <div class="card-body">
                      <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" name="title" id="title" value="{{ old('title')}}" placeholder="Enter name">
                        @error('title')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>

                      <div class="form-group">
                        <label for="title">Post title</label>
                        <select name="post_id" id="post_id" class="form-control">
                            <option value="">choose post</option>
                            @foreach ($posts as $post)
                             <option value="{{$post->id}}">{{$post->title}}</option>
                            @endforeach
                        </select>
                        @error('post_id')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>

                      <div class="form-group">
                        <label for="title">Vedio</label>
                        <input type="file" id="vedio" name="vedio">
                        @error('vedio')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>

                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="active" name="active" @checked(true)>
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
