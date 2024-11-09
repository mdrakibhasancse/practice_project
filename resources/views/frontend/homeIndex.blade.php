@extends('frontend.layouts.app')

@section('content')
<div class="container py-5">
    <div class="post-container">
        @include('frontend.includes.postItems')
    </div>
    <div class="text-center">
    <button data-next-page="{{$posts->nextPageUrl()}}" class="btn btn-outline-warning btn-large px-5 my-3 tap-to-see-more">
        <span class="spinner-border w3-text-red spinner-border-sm load-more-loader" style="display:none;">
        </span> See More
    </button>
    </div>
    <p class="text-center reached-at-end text-danger" style="display: none;font-size:20px;">Product not found</p>
  </div>
@endsection

@push('js')
<script>
    $(document).on('click','.tap-to-see-more', function(e){
        e.preventDefault();
        var that = $( this );
        $('.load-more-loader').show();
        var urlNext = that.attr('data-next-page');
        $.ajax({
            url: urlNext,
            type:"get",
            cache:false,
            }).done(function(response) {
                that.attr('data-next-page', response.next_page_url);
                $('.post-container').append(response.view);
                $('.load-more-loader').hide();
                if(response.next_page_url == null)
                {
                    that.hide();
                    $(".reached-at-end").show();
                }
        });
    });
</script>
@endpush
