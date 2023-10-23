<?php

namespace App\Models\User;

use App\Models\User;
use App\Models\comment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'body',
        'image',
        'user_id',
        'post_tags',
        'tagged_person'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
   
    public function comments(){
        return $this->hasMany(comment::class)->whereNull('parent_id');
    }
    
}
