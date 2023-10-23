<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\comment;

class CommentController extends Controller
{
    //
    public function storeComments(Request $req,$id){
        $id = $req->post_id;
       comment::insert([
        'comment_input'=> $req->comment_input,
        'parent_id' => 0,
        'post_id' => $id,
        'user_id' => $req->user_id
       ]);

       return redirect('/posts')->with('success','Comments added');
    }
    public function storeReply(Request $req){
      comment::insert([
         'comment_input'=> $req->comment_input,
         'parent_id' => $req->parent_id,
         'post_id' => $req->post_id,
         'user_id' => $req->user_id
        ]);

        return redirect('/posts')->with('success','Reply send');
    }
}
