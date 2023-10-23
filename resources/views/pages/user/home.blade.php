@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center ">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $user->name . __(' - Profile') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <div class="d-flex flex-row justify-content-around">
                        <ul class="profile-block">
                            <img src="/storage/{{$user->avatar}}" class="rounded-circle" width="100" height="100"/>
                            <form method="POST" action="/change-profileimg/{{$user->id}}" enctype="multipart/form-data">
                            @csrf
                            @method("PUT")
                            <label for="profileImage"> 
                             <a style="cursor: pointer;" class="avatar_block"><em class="fa fa-minus"></em></a></label> 
                            <input type="file" name="avatar" id="profileImage" style="display: none;">
                            <input type="submit" name="submit" value="Change" class="btn"/>
                            </form>
                            <li> {{ $user->name }}</li>
                            <li>{{ $user->email }}</li>
                            @if(auth()->user()->id !== $user->id)
                @if(auth()->user()->followings->contains($user->id))
                <a href="{{route('unfollow',['follower_id' => auth()->user()->id, 'following_id' => $user->id])}}" class="btn btn-sm btn-danger">unfollow</a>
                @else
                <a href="{{route('follow',['follower_id' => auth()->user()->id, 'following_id' => $user->id])}}" class="btn btn-sm btn-primary">follow</a>
                @endif
                @endif
                 <a href="/post-timeline/{{$user->id}}" class="btn btn-light">Post Timeline</a>
                            <!-- <li> Registered at: {{ $user->created_at->diffForHumans() }}</li> -->
                        </ul>
                        <br>
                        <ul>
                            <li> Posts count: {{ count($user->posts) }}</li>
                            <li>Followers:{{ count($user->followers) }}</li>
                            <li>Following:{{ count($user->followings) }}</li>
                        </ul>
                    </div>
                </div>
            </div>
            <br>
            <div class="card d-flex align-items-center ">
                <div class="card-body">
                @if(count($user->followers) > 0)
                    @foreach($user->posts->chunk(4) as $chunk)
                    <div class="flex-row">
                        @foreach ($chunk as $post)
                        <a href="{{ route('user.post.show',$post->id) }}">
                            <img src="{{ asset("storage/$post->image") }}" class="img-fluid rounded card-img-top " alt=""
                                srcset="" style="width: 20%; height: 20%;">
                        </a>
                        @endforeach
                    </div>
                    @endforeach
                    @else
                    <p>Account is private</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection