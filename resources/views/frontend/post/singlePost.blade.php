@extends('frontend.layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-md-8 blog-main">
               <div class="card">
                  <div class="card-body">
                    <div class="blog-post">
                        <h2 class="blog-post-title">{{ $post->title }}</h2>
                        <hr>
                        <p>{!! $post->description !!}</p>

                        {{-- comment show start --}}

                        <div class="card-">
                            <div class="card-comments my-0 py-0">
                                <div class="comments-container">
                                    @include('frontend.post.ajax.postComments')
                                </div>
                                @if($post->paginatedComments->nextPageUrl())
                                    <div class="d-flex justify-content-center pt-2">
                                        <p data-next-page="{{ $post->paginatedComments->nextPageUrl() }}"
                                            class="w3-center tap-to-commentSee-more">
                                            <span class="spinner-border w3-text-red spinner-border-sm load-more-comment-loader"
                                                style="display:none;">
                                            </span> <b role="button" class="w3-text-gray"> More Comments <i
                                                    class="fas fa-comment-dots"></i></b>
                                        </p>
                                        <p class="reached-at-end" style="display: none;"></p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        {{-- comment show end --}}


                        <hr>

                        <div class="">
                            @auth
                            <form action="{{ route('comment', ['type' => 'comment', 'id' => $post->id])}}" method="POST">
                                @csrf
                                <div class="input-group mb-3">
                                <input type="text" class="form-control comment-input-ajax" name="comment" placeholder="Press enter to comment...">
                                </div>
                            </form>
                            @endauth
                        </div>

                    </div>
                  </div>
               </div>
            </div>

            <aside class="col-md-4 blog-sidebar bg-light w3-round">
            <div class="p-3">
                <h4 class="font-italic">Categories</h4>
                <ol class="list-unstyled mb-0">
                @foreach ($categories as $category)
                <li><a href="#">{{$category->name}}</a></li>
                @endforeach
                </ol>
            </div>
            </aside><!-- /.blog-sidebar -->

        </div><!-- /.row -->
    </div>
@endsection

@push('js')
<script>
    $(function() {
        $(document).on('keydown', ".comment-input-ajax", function(e){
            if (e.keyCode == 13) {
                e.preventDefault();
                var that = $(this);
                var form = that.closest('form');
                var url = form.attr('action');
                $.ajax({
                type: "GET",
                url: url,
                data: form.serialize(),
                success: function(response)
                    {
                        $('.comments-container').append(response.page);
                        that.val('');
                    }
                });
            }
        });


        $(document).on('click','.tap-to-commentSee-more', function(e){
            e.preventDefault();
            var that = $( this );
            var load = that.find('.load-more-comment-loader').show();
            var urlNext = that.attr('data-next-page');
            $.ajax({
            url: urlNext,
            type:"get",
            cache:false,
            }).done(function(response) {
                that.closest('.card-comments').find('.comments-container').append(response.page);
                // that.closest('.card-comments').find('.replyreplyfrom').hide();
                load.hide();
                that.attr('data-next-page', response.nextPageUrl);
                if(response.nextPageUrl == null)
                {
                    that.closest('.card-comments').find('.reached-at-end').show();
                    that.remove();
                }
            });
        });

    });
</script>
@endpush
