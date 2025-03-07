@extends('template.layout')

@section('style')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style type="text/css">
    i{
        cursor: pointer;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Blogs List') }}</div>

                <div class="card-body">

                    <div class="row">
                        @foreach($blogs as $blog)
                        <div class="col-md-2">
                            <div class="card mt-2" style="width: 18rem;">
                             <img src="https://placehold.co/600x400" class="card-img-top p-1" alt="...">
                              <div class="card-body">
                                <h5 class="card-title">{{ $blog->title }}</h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                <div class="like-box">
                                    <i id="like-{{ $blog->id }}"
                                        data-blog-id="{{ $blog->id }}"
                                        class="like fa-thumbs-up {{ auth()->user()->hasLiked($blog->id) ? 'fa-solid' : 'fa-regular' }}"></i>
                                    <span class="like-count">{{ $blog->likes->count() }}</span>
                                    <i id="like-{{ $blog->id }}"
                                        data-blog-id="{{ $blog->id }}"
                                        class="dislike fa-thumbs-down {{ auth()->user()->hasDisliked($blog->id) ? 'fa-solid' : 'fa-regular' }}"></i>
                                    <span class="dislike-count">{{ $blog->dislikes->count() }}</span>
                                </div>
                              </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" referrerpolicy="no-referrer"></script>
<script type="text/javascript">
    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.like-box i').click(function(){
            var id = $(this).attr('data-blog-id');
            var boxObj = $(this).parent('div');
            var c = $(this).parent('div').find('span').text();
            var like = $(this).hasClass('like') ? 1 : 0;

            $.ajax({
               type:'POST',
               url: "{{ route('blogs.ajax.like.dislike') }}",
               data:{ id:id, like:like },
               success:function(data){

                    if (data.success.hasLiked == true) {

                        if($(boxObj).find(".dislike").hasClass("fa-solid")){
                            var dislikes = $(boxObj).find(".dislike-count").text();
                            $(boxObj).find(".dislike-count").text(parseInt(dislikes)-1);
                        }

                        $(boxObj).find(".like").removeClass("fa-regular");
                        $(boxObj).find(".like").addClass("fa-solid");

                        $(boxObj).find(".dislike").removeClass("fa-solid");
                        $(boxObj).find(".dislike").addClass("fa-regular");

                        var likes = $(boxObj).find(".like-count").text();
                        $(boxObj).find(".like-count").text(parseInt(likes)+1);

                    } else if(data.success.hasDisliked == true){

                        if($(boxObj).find(".like").hasClass("fa-solid")){
                            var likes = $(boxObj).find(".like-count").text();
                            $(boxObj).find(".like-count").text(parseInt(likes)-1);
                        }

                        $(boxObj).find(".like").removeClass("fa-solid");
                        $(boxObj).find(".like").addClass("fa-regular");

                        $(boxObj).find(".dislike").removeClass("fa-regular");
                        $(boxObj).find(".dislike").addClass("fa-solid");

                        var dislike = $(boxObj).find(".dislike-count").text();
                        $(boxObj).find(".dislike-count").text(parseInt(dislike)+1);
                    } else {
                        if($(boxObj).find(".dislike").hasClass("fa-solid")){
                            var dislikes = $(boxObj).find(".dislike-count").text();
                            $(boxObj).find(".dislike-count").text(parseInt(dislikes)-1);
                        }

                        if($(boxObj).find(".like").hasClass("fa-solid")){
                            var likes = $(boxObj).find(".like-count").text();
                            $(boxObj).find(".like-count").text(parseInt(likes)-1);
                        }

                        $(boxObj).find(".like").removeClass("fa-solid");
                        $(boxObj).find(".like").addClass("fa-regular");

                        $(boxObj).find(".dislike").removeClass("fa-solid");
                        $(boxObj).find(".dislike").addClass("fa-regular");

                    }
               }
            });

        });

    });
</script>
@endsection
