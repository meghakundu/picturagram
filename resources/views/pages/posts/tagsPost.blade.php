@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
      <div class="posts-tags"><span>#{{ collect(request()->segments())->last()}}</span>
      <p>{{$postsByTag->count()}}posts count</p>
      </div>
      <div class="recent-posts">
        <h3>Top posts</h3>
      @foreach($postsByTag->chunk(4) as $chunk)
      <div class="flex-row">
      @foreach ($chunk as $post)
      <a href="{{route('user.post.show',$post->id) }}">
      <img src="{{asset("storage/$post->image") }}" class="img-fluid rounded card-img-top" alt="" srcset="" style="width:30%; height:40%">
      </a>
      @endforeach
      </div>
      @endforeach
    </div> 
</div>
</div>
@endsection