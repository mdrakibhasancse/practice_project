@extends('admin.layouts.app')
@section('content')
  <div class="card">
    {{-- <div class="card-header">
        <div class="card-title">
          Posts All
        </div>

        <div class="card-tools">
           <a href="{{ route('admin.posts.create')}}" class="btn btn-primary btn-sm">New Post Create</a>
        </div>
    </div> --}}

    <div class="card-header">
        <div class="card-title">
            Vedios All
        </div>
        <div class="card-tools">
          <div class="input-group input-group-sm" style="width: 150px;">
            <input type="text" name="table_search" class="form-control float-right vedio-search" data-url="{{ route('admin.vedios.search') }}" placeholder="Search">

            <div class="input-group-append">
              <button type="submit" class="btn btn-default">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </div>
        </div>
    </div>


     <div class="card-body">
        <div class="table-responsive table-responsive-sm data-container">
            @includeIf('admin.vedios.searchData')
        </div>
        <div class="w3-small float-right pt-1">
            @if(count($vedios))
                <div class="pull-left">
                    {!! $vedios->links() !!}
                </div>
            @endif
        </div>
     </div>
  </div>
@endsection

@push('js')
  {{-- <script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script> --}}
{{-- <script src="sweetalert2.all.min.js"></script> --}}
  <script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function () {
        $(document).on('click', ".vedioDelete", function(e){
            e.preventDefault();
            var that = $( this );
            var url = that.attr('data-url');
            if (confirm("Are you sure you want to delete this vedio?")) {
                $.ajax({
                    url: url,
                    method: "DELETE",
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response)
                    {
                        if(response.success){
                            that.closest('tr').remove();
                            const Toast = Swal.mixin({
                                toast: true,
                                position: "top-end",
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.onmouseenter = Swal.stopTimer;
                                    toast.onmouseleave = Swal.resumeTimer;
                                }
                                });
                                Toast.fire({
                                icon: "success",
                                title: response.success
                            });
                        }else{
                            const Toast = Swal.mixin({
                                toast: true,
                                position: "top-end",
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.onmouseenter = Swal.stopTimer;
                                    toast.onmouseleave = Swal.resumeTimer;
                                }
                                });
                                Toast.fire({
                                icon: "error",
                                title: response.error
                            });
                        }

                    }
                });
            }
        });

      $(document).on('click', ".vedioStatus", function(e){
        e.preventDefault();
        var that = $( this );
        var url = that.attr('data-url');
        $.ajax({
            url: url,
            method: "get",
            success: function(response)
            {
               if(response.active == true)
               {
                  that.removeClass('badge-danger').addClass('badge-primary');
                  that.text('Active');
               }
               else
               {
                  that.removeClass('badge-primary').addClass('badge-danger');
                  that.text('Inactive');
               }
            }
        });
      });

    $(document).on('keyup', ".vedio-search", function(e){
        e.preventDefault();
        var that = $( this );
        var url = that.attr('data-url');
        var q = that.val();
        $.ajax({
            url: url,
            data : {q:q},
            method: "get",
            success: function(res)
            {
                if(res.success)
                {
                    $(".data-container").empty().append(res.page);
                }
            }
        });
      });
    });
  </script>
@endpush
