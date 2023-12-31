<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User\Post;

class comment extends Model
{
    use HasFactory;
    protected $table = 'comments';
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function post(){
        return $this->belongsTo(Post::class);
    }

    public function replies(){
        return $this->hasMany(Comment::class,'parent_id');
    }
}
