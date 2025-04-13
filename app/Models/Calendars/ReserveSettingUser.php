<?php

namespace App\Models\Calendars;

use Illuminate\Database\Eloquent\Model;


class ReserveSettingUser extends Model
{
    //
    protected $fillable = [
        'user_id',
        'reserve_setting_id',
    ];
}
