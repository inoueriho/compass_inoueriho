<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Model;

use App\Models\Users\User;

class Subjects extends Model
{
    const UPDATED_AT = null;


    protected $fillable = [
        'subject'
    ];

    public function users(){
        return $this->belongsToMany(User::class,'subject_users','user_id','subject_id');// リレーションの定義
                                              //'多対多のための中間テーブル',
    }
}
