<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    const UPDATED_AT = null;

    protected $fillable = [
        'like_user_id',
        'like_post_id'
    ];

    public function likeCounts($post_id){
        return $this->where('like_post_id', $post_id)->get()->count();
    }

    public function posts(){
        return $this->belongTo('App\Models\posts\post');
    }

    public function is_Like(){
        return $this->belongsTo('App\Models\posts\like');
    }
}
