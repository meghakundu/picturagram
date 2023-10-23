<?php

namespace App\Http\Controllers\User;

use App\Models\User\Post;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\PostRequest;
use Illuminate\Support\Facades\Storage;
use App\Models\comment;
use App\Models\User;
use App\Models\follow;
use Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->with(['user'])->get();
        $comments = comment::with(['user','post'])->get();
        return view('pages.posts.index',compact('posts','comments'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\User\PostRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $image = Storage::disk('public')->putFile('posts', $request->file('image'));
       $cloud_storimg = cloudinary()->upload($request->file('image')->getRealPath())->getSecurePath();
        $post = Post::create([
            'body' => $request->body,
            'image' => $image,
            'user_id' => auth()->id(),
            'post_tags' => $request->post_tags,
            'tagged_person' => 0
        ]);

        return back(302);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::where('id','=',$id)->with('user')->first();
        $comments = comment::with(['user','post'])->get();
        return view('pages.posts.show',compact('post','comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\User\PostRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
        Post::where('id','=', $id)->update($request->validated());

        return back(302);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::destroy($id);

        return back(302);
    }

    public function inboxChat(){
        if(Auth::check()) {
            $followingId = follow::select('*')
            ->where('follower_id','=',auth()->user()->id)
            ->first();
           if(!empty($followingId)){
               $users = User::with(['followings'])->select("*")
                            ->whereNotNull('last_seen')
                            ->where('id','=',$followingId->follower_id)
                            ->orderBy('last_seen', 'ASC')->get();
             }   else{
                $users = User::select("*")
                ->whereNull('last_seen')->get();
               }
            $current_user = User::select("*")->where('id',auth()->user()->id)->first();
            return view('pages.inbox',compact('users','current_user'));    
            }
    }

    public function tagsByPost($tagPost){
        $postsByTag = Post::latest()->where('post_tags','like','%'.$tagPost.'%')->get();
       return view('pages.posts.tagsPost',compact('postsByTag'));
    }
    
    public function postTimeline($id){
        $events = [];
 
        $appointments = Post::where('user_id',auth()->user()->id)->get();
 
        foreach ($appointments as $appointment) {
            $events[] = [
                'title' => $appointment->body,
                'start' => $appointment->created_at
            ];
        }

       return view('pages.posts.post-timeline',compact('events'));
    }
}
