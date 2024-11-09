@extends('admin.layouts.app')
@section('content')
<div class="row">
    <div class="col-md-8 offset-2">
        <div class="card">
            <div class="card-header py-1">
                <div class="card-title">
                  Post Create
                </div>
                <div class="card-tools">
                   <a href="{{ route('admin.posts.index')}}" class="btn btn-primary btn-sm">Back</a>
                </div>
            </div>
            <form action="{{ route('admin.posts.store')}}" method="POST" enctype="multipart/form-data">
               @csrf

                <div class="card-body py-1">
                    <div class="card-body">
                      <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" name="title" id="title" value="{{ old('title')}}" placeholder="Enter title">
                        @error('title')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="excerpt">Excerpt</label>
                        <textarea name="excerpt" id="excerpt" placeholder="Enter excerpt" value="{{ old('excerpt')}}" class="form-control" rows="2"></textarea>
                      </div>


                      <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="summernote" class="form-control" rows="5"
                         placeholder="Enter description">{{old('description')}}</textarea>
                      </div>

                      <div class="form-group">
                        <label for="exampleInputFile">Image Name</label>
                        <div class="input-group">
                          <div class="">
                            <input type="file" id="image" name="image">
                            <label for="image"></label>
                          </div>
                        </div>
                        @error('image')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="active" name="active" @checked(true)>
                        <label class="form-check-label" for="active">Active</label>
                      </div>
                    </div>
                    <!-- /.card-body -->


                    @if($categories->count() > 0)
                        <div class="card card-primary card-outline">
                            <div class="card-header with-border">
                                <h3 class="card-title">Add Category</h3>
                            </div>
                            <div class="card-body p-2">
                                <div class="row">
                                    @foreach($categories as $cat)
                                    <div class="col-md-4">
                                        <div class="category-area">
                                            <div class="custom-control custom-checkbox bg-light rounded-lg mb-1">
                                            <input type="checkbox" class="custom-control-input " id="customCheckId_{{ $cat->id }}"  name="categories[]" value="{{$cat->id}}">
                                            <label class="custom-control-label" for="customCheckId_{{ $cat->id }}">{{ $cat->name ?? $cat->name }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif


                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-sm float-right">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
