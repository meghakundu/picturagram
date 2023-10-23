<div class="card rounded my-2">
    <div class="card-header bg-white border-white">
        <div class="d-flex flex-row align-items-baseline justify-content-between">
            <div class="flex-shrink-0">
                @php
                $profile_img = $post->user->avatar;
                @endphp
                <img src="{{ asset("storage/$profile_img") }}" alt="" class="rounded-circle" width="48" height="48">

            </div>
            <div class="flex-grow-1 ms-3">

                <a class="text-decoration-none" href="{{ route('home',$post->user->id) }}">
                    <h5 class="ml-2 text-primary text-break ">
                        {{ $post->user->name ?? 'Unknown User' }}
                    </h5>
                </a>
               <!-- <button class="">Follow</button> -->
               @if(auth()->user()->id !== $post->user_id)
                @if(auth()->user()->followings->contains($post->user_id))
                <a href="{{route('unfollow',['follower_id' => auth()->user()->id, 'following_id' => $post->user_id])}}" class="btn btn-sm btn-danger">unfollow</a>
                @else
                <a href="{{route('follow',['follower_id' => auth()->user()->id, 'following_id' => $post->user_id])}}" class="btn btn-sm btn-primary">follow</a>
                @endif
                @endif
            </div>
            <div class="flex-end">
                @if($post->user_id === auth()->user()->id)
                <div class="dropdown text-right">
                    <button class="btn btn-secondary border-white dropdown-toggle" type="button" id="dropdownMenuButton"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        ...
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                    
                        <button class="dropdown-item" data-toggle="modal" data-target="#editModal{{$post->id}}">
                            Edit Post
                        </button>
                        <button class="dropdown-item" data-toggle="modal" data-target="#tagperson{{$post->id}}">
                            Tag Person
                        </button>
                        <form action="{{ route('user.post.destroy',$post->id) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type=" submit" class="dropdown-item">Delete Post</button>
                         </form>
                        
                    </div>
                </div>
                @endif
                <sup class="text-muted text-break">
                    {{ $post->created_at->diffForHumans() }}
                </sup>
            </div>
        </div>
        <div class="flex-row mt-3">
            <p class="card-text">
                {{ $post->body }} 
            </p>
            @php
            $tags_arr[]=explode(',',$post->post_tags);
            $tagname = App\Models\User::select('name')->where('id',$post->tagged_person)->first();
            @endphp
            @foreach($tags_arr[0] as $tagItem)
            @if($tagItem!=0)
            <a href="/explore/tags/{{$tagItem}}" target="_blank">#{{$tagItem}}</a>
            @endif
            @endforeach  

            @if($post->tagged_person!=0) 
           <p>@<a href="/users/{{$post->tagged_person}}" target="_blank">{{$tagname->name}}</a></p>
            @endif
        </div>
    </div>
    <a class="text-decoration-none" href="{{ route('user.post.show',$post->id) }}">
        <div class="card-body">
            <img class="card-img-top img-fluid rounded" src="{{ asset("storage/$post->image") }}" alt="" srcset="">
        </div>
    </a>
    <div class="card-footer bg-white border-white">
        <div class="btn-group">
            @if($post->user_id != auth()->user()->id)
            <a href="" class="btn">
                <i class="fa fa-heart"></i>
            </a>
            @endif
            &nbsp; &nbsp;
            <div id="box">
            <span class="btn commentBox" data-id="{{$post->id}}">
            <i class="fa fa-comment"></i>
            </span>
            <div id="replycomment-{{$post->id}}">
            @if($post->user_id != auth()->user()->id)
            <form method="post" id="" action="/add-comment/{{$post->id}}">
             @csrf
            <div class="form-group">
             <input type="text" name="comment_input" placeholder="Add Comment..." class="form-control" />
             <input type="hidden" name="post_id" value="{{ $post->id }}" />
             <input type="hidden" name="user_id" value="{{auth()->user()->id}}"/>
            </div>
            <div class="form-group">
            <input type="submit" class="btn btn-warning" value="Post" />
            </div>
            </form>
            @endif
            <div class="replyBox">
            <h3>Comments</h3>
            @foreach($comments as $item)
            @if($item['parent_id']==0 && $item['post_id']==$post->id)
            <img src="/storage/{{$item['user']['avatar']}}" class="rounded-circle" width="48" height="48"/><span>{{$item['user']['name']}}</span>
            <p>{{$item['comment_input']}}</p>
            <form method="post" id="replyform" action="/reply-comment">
                    @csrf
                    <div class="form-group">
                    <input type="text" name="comment_input" placeholder="reply to.." class="form-control" />
                    <input type="hidden" name="user_id" value="{{auth()->user()->id }}" />
                    <input type="hidden" name="parent_id" value="{{$item['id']}}"/>
                    <input type="hidden" name="post_id" value="{{$item['post']['id']}}"/>
                    </div>
                    <div class="form-group">
                    <input type="submit" class="btn" value="Reply" />
                    </div>
            </form>
            @endif
            @if($item['parent_id']!=0 && $item['post_id']==$post->id)
            <img src="/storage/{{$item['user']['avatar']}}" class="rounded-circle" width="48" height="48"/>
            <span>{{$item['user']['name']}}</span>
            <p>{{$item['comment_input']}}</p>
            @endif
            @endforeach
            </div>
            </div>
            </div>
        </div>
    </div>  
</div>
<script type="text/javascript">
       $(".commentBox").click(function(){
            // this will query for the clicked toggle
            var $toggle = $(this); 
            console.log($toggle);
            // build the target form id
            var id = "#replycomment-" + $toggle.data('id'); 
            $(id).toggle();
            const form = document.getElementById('id');
            if (form.style.display === 'none') {
                form.style.display = 'block';
            } else {
                form.style.display = 'none';
            }
        });
   
</script>
@include('pages.posts.components.modal',$post)
@include('pages.posts.components.tagPerson')
