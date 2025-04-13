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

class CalendarsController extends Controller
{
    public function show(){
        $calendar = new CalendarView(time());
        return view('authenticated.calendar.general.calendar', compact('calendar'));
    }

    public function reserve(Request $request){
        DB::beginTransaction();
        try{
            $getPart = $request->getPart;
            $getDate = $request->getData;
            $reserveDays = array_filter(array_combine($getDate, $getPart));
            foreach($reserveDays as $key => $value){
                $reserve_settings = ReserveSettings::where('setting_reserve', $key)->where('setting_part', $value)->first();
                $reserve_settings->decrement('limit_users');
                $reserve_settings->users()->attach(Auth::id());
            }
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
        }
        return redirect()->route('calendar.general.show', ['user_id' => Auth::id()]);
    }
    // public function delete(Request $request){
    //     $user_id = Auth::id();
    //     $id = $request->input('reserve-setting-id');
    //     dd($id);
    //     // ReserveSettings::findOrFail($id)->delete();
    //     // 本人の予約かどうか確認してから削除
    //     $reserve = ReserveSettings::where('id', $id)->where('user_id', $user_id)->first();
    //    if ($reserve) {
    //     $reserve->delete();
    //     }
    //     // user_idが必要になるから渡す
    //     return redirect()->route('calendar.general.show', ['user_id' => $user_id]);
    // }
    public function delete(Request $request){
    $user_id = Auth::id();
    $id = $request->input('reserve-setting-id');
    // ReserveSettingUser テーブルから予約を探す
    $reserve = ReserveSettingUser::where('reserve_setting_id', $id)
                ->where('user_id', $user_id)->first();
    if ($reserve) {
        $reserve->delete();
    }
    return redirect()->route('calendar.general.show', ['user_id' => $user_id]);
}

}
