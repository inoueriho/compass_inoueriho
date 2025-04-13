<?php

namespace App\Models\Categories;

use Illuminate\Database\Eloquent\Model;
use App\Models\Categories\MainCategory;
use App\Models\Posts\Post;

class SubCategory extends Model
{
    const UPDATED_AT = null;
    const CREATED_AT = null;
    protected $fillable = [
        'main_category_id',
        'sub_category',
    ];
    public function mainCategory(){
        // リレーションの定義
        return $this->belongTo(MainCategory::class);
    }

    public function posts(){
        // リレーションの定義
                return $this->belongsToMany(Post::class,'post_sub_categories','sub_category_id','post_id',);
    }
    // サブカテゴリーに該当する投稿
    // public function subCategoryPost(){
    //     return Post::where('sub_category_id', 'sub_category_id');
    // }
}
