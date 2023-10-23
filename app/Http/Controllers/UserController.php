<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\User\Post;

class UserController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function follow($following_id, $follower_id){
        $follower = User::find($follower_id);
        $following = User::find($following_id);
        $follower->followings()->attach($following);
        return redirect()->back();
    }

    public function unfollow($following_id, $follower_id){
        $follower = User::find($follower_id);
        $following = User::find($following_id);
        $follower->followings()->detach($following);
        return redirect()->back();
    }

    public function taggedPersonPosts(Request $request)
    {
          $query = $request->get('query');
          $filterResult = User::where('name', 'LIKE', '%'. $query. '%')
                         ->where('id','!=',auth()->user()->id)->get();
         //$result = json_encode($filterResult);
         $taggedId = User::select('id')->where('name',$_GET['tagged_person'])->first();
         $taggedPost = Post::find($_GET['id'])->update([
            'tagged_person' => $taggedId->id
        ]);
          return redirect('/')->with(['success','tagged']);
          
    }
    
    public function autocompleteSearch(Request $req){
        $query = $req->get('query');
          $filterResult = User::where('name', 'LIKE', '%'. $query. '%')
                         ->where('id','!=',auth()->user()->id)->get();
         return response()->json($filterResult);
    }

    public function search(Request $request){
 
        if($request->ajax()){
            $keyword = $request->search;
            $data=Post::where('body','like','%'.$keyword.'%')
                  ->orWhereHas('user', function($q) use ($keyword){
                    $q->where('name','like','%'. $keyword . '%');
               })->get();
           
            $output='';
            if(count($data)>0){
                $output ='
                    <table id="userTable" class="table">
                    <tbody>';
                        foreach($data as $row){
                            $output .='
                            <tr>
                            <td><a href="/posts/'.$row->id.'">'.$row->body.'</a></td>
                            <td><a href="/users/'.$row->id.'">'.$row->user->name.'</a></td>
                            </tr> ';
                        }
                $output .= '
                    </tbody>
                    </table>';
            }
            else{
                $output .='No results';
            }
            return $output;
        }
    }

   
}
