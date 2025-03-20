<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;

use App\Models\Users\User;
use App\Models\Posts\Post;

class PostComment extends Model
{
    const UPDATED_AT = null;
    const CREATED_AT = null;

    protected $fillable = [
        'post_id',
        'user_id',
        'comment',
    ];

    // postsテーブルとposts_commentのリレーション
    public function post(){
        return $this->belongsTo('App\Models\Posts\Post');
    }

    // public function commentCounts($post_comment){
    //     return $this->where('post_id', $post_comment)->get()->count();
    // }

    public function commentUser($user_id){
        return User::where('id', $user_id)->first();
    }
}
