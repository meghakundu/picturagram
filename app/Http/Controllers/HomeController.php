<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($id)
    {
        $user = User::where('id',$id)->with(['posts'])->first();

        return view('pages.user.home',compact('user'));
    }

    public function updateProfileImg($id,Request $request){
        $image = Storage::disk('public')->putFile('users', request()->avatar);
        $user = User::find($id);
        $user->update([
            'avatar' => $image
        ]);
    
        return redirect()->back();
    }

    public function usersList(Request $request)
    {
        $users = User::select("*")
                        ->whereNotNull('last_seen')
                        ->orderBy('last_seen', 'ASC')
                        ->paginate(10);
          
        return view('users', compact('users'));
    }
}
