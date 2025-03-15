<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;
use App\Models\Posts\Like;
use App\Models\Posts\PostComment;
use Auth;

class Post extends Model
{
    const UPDATED_AT = null;
    const CREATED_AT = null;

    protected $fillable = [
        'user_id',
        'post_title',
        'post',
    ];

    public function user(){
        return $this->belongsTo('App\Models\Users\User');
    }
    public function subCategories(){
        // リレーションの定義
    }

    // postCommentsとのリレーション　postsから見ると一つの投稿に複数コメントつくため1対多のリレーション
    public function postComments(){
        return $this->hasMany('App\Models\Posts\PostComment');
    }
    // コメント数
    public function commentCounts($posts){
        return Post::with('PostComments')->find($posts);
    }

    //likeとのリレーションの定義　postsから見ると一つの投稿に複数いいねつくため１対多のリレーション
    public function likes(){
        return $this->hasMany('App\Models\posts\like');
    }
//     public function is_like_by_auth_user()
//   {
//     $id = Auth::id();

//     $likers = array();
//     foreach($this->likes as $like) {
//       array_push($likers, $like->user_id);
//     }

//     if (in_array($id, $likers)) {
//       return true;
//     } else {
//       return false;
//     }
//   }
}
