@extends('layouts.app')

@auth
@section('title', '- Posts')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-8">
            <div class="card my-3" id="postsAdd">
                <div class="card-body">
                    <form action="{{ route('user.post.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <textarea class="form-control" placeholder="Aa" name="body" id="" cols="20"
                                rows="4"></textarea>
                            <input class="form-control py-2" type="file" name="image" id="">
                            Tags:<input class="form-control" type="text" name="post_tags"/>
                            <br>
                            <input class="btn btn-primary btn-block" type="submit" value="Publish">
                        </div>
                    </form>
                </div>
            </div>
            @foreach($posts as $post)
                @include('pages.posts.components.post',$post)
                <br>
            @endforeach
        </div>
        
        <div class="col-sm-12 col-md-4">
        <div classs="form-group">
            <input type="text" id="search" name="search" placeholder="Search friends and posts.." class="form-control" />
            
        </div>
        <div id="search_list"></div>
        </div>
       
    </div>
</div>
<script src="/amsify/jquery.amsify.suggestags.js"></script>
<script type="text/javascript">
    $('input[name="post_tags"]').amsifySuggestags();
        $('#search').on('keyup',function(){
            var query= $(this).val(); 
            $.ajax({
                url:"search",
                type:"GET",
                data:{'search':query},
                success:function(data){ 
                    $('#search_list').html(data);
                }
            });
             //end of ajax call
        });
</script>
@endsection
@endauth
@guest
@section('content')
<div class="container">
<div class="row justify-content-center">
<p>Sign up to see <i>photos</i> and <br> <i>videos</i> from your friends.</p>
</div>
</div>
@endsection
@endguest