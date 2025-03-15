<?php

namespace App\Models\Categories;

use Illuminate\Database\Eloquent\Model;
use App\Models\Categories\MainCategory;

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
        return $this->belongTo('App\Models\Categories\MainCategory');
    }

    public function posts(){
        // リレーションの定義
    }
}
