<?php
namespace App\Calendars\General;

use Carbon\Carbon;
use Auth;

class CalendarView{

  private $carbon;
  function __construct($date){
    $this->carbon = new Carbon($date);
  }

  public function getTitle(){
    return $this->carbon->format('Y年n月');
  }
// スクール予約
  function render(){
    $html = [];
    $html[] = '<div class="calendar text-center">';
    $html[] = '<table class="table">';
    $html[] = '<thead>';
    $html[] = '<tr>';
    $html[] = '<th class="border">月</th>';
    $html[] = '<th class="border">火</th>';
    $html[] = '<th class="border">水</th>';
    $html[] = '<th class="border">木</th>';
    $html[] = '<th class="border">金</th>';
    $html[] = '<th class=" border weekend1">土</th>';
    $html[] = '<th class=" border weekend2">日</th>';
    $html[] = '</tr>';
    $html[] = '</thead>';
    $html[] = '<tbody>';
    $weeks = $this->getWeeks();
    foreach($weeks as $week){
      $html[] = '<tr class="'.$week->getClassName().'">';

      $days = $week->getDays();
      // dd($days);
      foreach($days as $day){
        $days = $week->getDays();
        // 過去日を判定して色を変える処理
        // 現在の月の1日を取得
        $startDay = $this->carbon->copy()->format("Y-m-01");
        // 今日の日付を取得
        $toDay = $this->carbon->copy()->format("Y-m-d");
        // 各dayが過去日かどうか判定する
        if($startDay <= $day->everyDay() && $toDay >= $day->everyDay()){
          $html[] = '<td class="calendar-td past-day">';
        }else{
          $html[] = '<td class="calendar-td '.$day->getClassName().'">';
          // 予約がある場合、参加部数を表示
          // $html[] = $day->render();  // 日付の表示
          // $html[] = $reservation->getParticipatedCount() . '部'; // 参加部数の表示
          // $html[] = '</td>';
        }
        // 日付そのものを表示する
        $html[] = $day->render();


        // 予約しているかの判断
        if(in_array($day->everyDay(), $day->authReserveDay())){
          // setting_part(予約した部)は123のどれなのか取得してる
          $reservePart = $day->authReserveDate($day->everyDay())->first()->setting_part;
          // ここでそれぞれ123をラベルに変換している
          if($reservePart == 1){
            $reservePartLabel = "リモ1部";
          }else if($reservePart == 2){
            $reservePartLabel = "リモ2部";
          }else if($reservePart == 3){
            $reservePartLabel = "リモ3部";
          }
          if($startDay <= $day->everyDay() && $toDay >= $day->everyDay()){
            // 過去日なら参加表示
            $html[] = '<p class="m-auto p-0 w-75" style="font-size:12px"></p>';
            $reserveData = $day->authReserveDate($day->everyDay())->first();
            $html[] = $reserveData->setting_part . '部参加';
            $html[] = '<input type="hidden" name="getDate[]" value="'. $day->everyDay() .'" form="reserveParts">';
            $html[] = '<input type="hidden" name="getPart[]" value="" form="reserveParts">';
          }else{
            // 未来日だったら予約取り消しボタン表示
            $reserveData = $day->authReserveDate($day->everyDay())->first();
            $deletePart = $reserveData->setting_part;
            $reserveReserve = $reserveData->setting_reserve;
            // 上に定義してから使う$reserveData/$reservePart
            // モーダル操作時にフォーム送信されないようにtypeはbutton
            // 予約日や時間を取得するために属性追加(setting_reserve/setting_part)
            $html[] = '<button type="button" class="btn btn-danger cancel-modal-open p-0 w-75" name="delete_date" style="font-size:12px"
            data-id="'. $reserveData->id .'"
            setting_reserve="'. $reserveData->setting_reserve .'"
            setting_part="'. $reserveData->setting_part .'">' . $reservePartLabel .'</button>';
            $html[] = '<input type="hidden" name="getDate[]" value="'. $day->everyDay() .'" form="reserveParts">';
            // $html[] = '<input type="hidden" name="getPart[]" value="'. $deletePart .'" form="deleteParts">';
            $html[] = '<input type="hidden" name="getPart[]" value="" form="reserveParts">';
          }
        }else{
          // 予約がない日
          if($startDay <= $day->everyDay() && $toDay >= $day->everyDay()){
            // dd($day->everyDay());
          // 過去日だったら → プルダウン表示しない、受付終了
            $html[] = '<p class="m-auto p-0 w-75 text-muted";">受付終了</p>';
            $html[] = '<input type="hidden" name="getDate[]" value="'. $day->everyDay() .'" form="reserveParts">';
            $html[] = '<input type="hidden" name="getPart[]" value="" form="reserveParts">';

          }else{
          // 未来日だったら → プルダウン表示
          // selectPartの中身CalenderWeekDay.phpにある
          $html[] = $day->selectPart($day->everyDay());
          $html[] = '<input type="hidden" name="getDate[]" value="'. $day->everyDay() .'" form="reserveParts">';
          // $html[] = '<input type="hidden" name="getPart[]" value="" form="reserveParts">';
          }
        }
        $html[] = $day->getDate();
        $html[] = '</td>';

      }
      $html[] = '</tr>';
    }
    $html[] = '</tbody>';
    $html[] = '</table>';
    $html[] = '</div>';
    $html[] = '<form action="/reserve/calendar" method="post" id="reserveParts">'.csrf_field().'</form>';
    $html[] = '<form action="/delete/calendar" method="post" id="deleteParts">'.csrf_field().'</form>';

    return implode('', $html);
  }

  protected function getWeeks(){
    $weeks = [];
    $firstDay = $this->carbon->copy()->firstOfMonth();
    $lastDay = $this->carbon->copy()->lastOfMonth();
    $week = new CalendarWeek($firstDay->copy());
    $weeks[] = $week;
    $tmpDay = $firstDay->copy()->addDay(7)->startOfWeek();
    while($tmpDay->lte($lastDay)){
      $week = new CalendarWeek($tmpDay, count($weeks));
      $weeks[] = $week;
      $tmpDay->addDay(7);
    }
    return $weeks;
  }
}
