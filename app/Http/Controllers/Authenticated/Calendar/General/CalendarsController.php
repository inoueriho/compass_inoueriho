<?php

namespace App\Http\Controllers\Authenticated\Calendar\General;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Calendars\General\CalendarView;
use App\Models\Calendars\ReserveSettings;
use App\Models\Calendars\Calendar;
use App\Models\USers\User;
use App\Models\Calendars\ReserveSettingUser;
use Auth;
use DB;
// 生徒のスクール予約画面
class CalendarsController extends Controller
{
    // カレンダー表示
    public function show(){
        $calendar = new CalendarView(time());
        return view('authenticated.calendar.general.calendar', compact('calendar'));
    }

    // 予約機能
    public function reserve(Request $request){
        // dd($request);
    DB::beginTransaction();
    try {
        $getPart = $request->getPart;
        $getDate = $request->getDate;
        // ↓nullの値を除外する
        $getDate = array_filter($getDate, function($value) {
            return !is_null($value);
        });
        // $getPart = array_filter($getPart, function($value) {
        //     return !is_null($value);
        // });
        // 重複を除外
        $getDate = array_unique($getDate);
        // $getPart = array_unique($getPart);
        // dd($getDate, $getPart);
if (count($getDate) !== count($getPart)) {
    dd('DateとPartの数が一致していません', $getDate, $getPart);
}

        $reserveDays = array_filter(array_combine($getDate, $getPart));
        $reserveData = $request->input('reserve', []);
        foreach($reserveDays as $key => $value){
            if ($part === '') continue; // 未選択はスキップ
            $reserve_settings = ReserveSettings::where('setting_reserve', $key)
                                                ->where('setting_part', $value)
                                                ->first();
                                            //↓枠数
            $reserve_settings->decrement('limit_users');
            $reserve_settings->users()->attach(Auth::id());
        }

        DB::commit();
    } catch(\Exception $e){
        DB::rollback();
    }

    return redirect()->route('calendar.general.show', ['user_id' => Auth::id()]);
}



    // 削除機能
    public function delete(Request $request){
        // $reserveId = $request->input('reserve_id');
        // $reserveDate = $request->input('reserve_date');
    $user_id = Auth::id();
    $id = $request->input('reserve-setting-id');
    // dd($id);
    // dd($request->all());
    // ReserveSettingUser テーブルから予約を探す
    $reserve = ReserveSettingUser::where('user_id', auth()->id())
    ->where('reserve_setting_id', $id)
    ->first();
    //  ↓上で取ってきた値が入る
    if ($reserve) {
        $reserve->delete();
        $setting = ReserveSettings::find($id);
        if ($setting) {
            $setting->limit_users += 1; // または $setting->limit += 1 など
            $setting->save();
        }
        // dd($setting->limit_users);
    }

    return redirect()->route('calendar.general.show', ['user_id' => $user_id]);
}

}
