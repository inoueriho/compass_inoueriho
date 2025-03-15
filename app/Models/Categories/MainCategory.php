<?php

namespace App\Models\Categories;

use Illuminate\Database\Eloquent\Model;
use App\Models\Categories\SubCategory;

class MainCategory extends Model
{
    const UPDATED_AT = null;
    const CREATED_AT = null;
    protected $fillable = [
        'main_category'
    ];

    // メインカテゴリーから見ると複数のサブカテゴリーがある
    public function subCategory(){
        // リレーションの定義
        return $this->hasMany('App\Models\Categories\MainCategory');
    }

}
