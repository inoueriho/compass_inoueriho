<!-- スクール予約画面 -->
@extends('layouts.sidebar')

@section('content')
<div class="vh-100 pt-5" style="background:#ECF1F6;">
  <div class="border w-75 m-auto pt-5 pb-5" style="border-radius:5px; background:#FFF;">
    <div class="w-75 m-auto border" style="border-radius:5px;">

      <p class="text-center">{{ $calendar->getTitle() }}</p>
      <div class="">
        {!! $calendar->render() !!}
      </div>
    </div>
    <div class="text-right w-75 m-auto">
      <input type="submit" class="btn btn-primary" value="予約する" form="reserveParts" onclick="return confirm('予約してよろしいですか？')">
      <!-- <input type="hidden" name="getDate[]" value="'. $day->everyDay() .'" form="reserveParts">
      <input type="hidden" name="getPart[]" value="'. $reservePart .'" form="reserveParts"> -->
    </div>
  </div>
</div>
<!-- モーダルの中身 -->
<div class="modal js-modal">
  <div class="modal__bg js-modal-close"></div>
  <div class="modal__content">
    <form action="{{ route('deleteParts') }}" method="post">
      <div class="w-100">
        <div class="modal-inner-cancel w-50 m-auto">
          <p class="modal-reserve-date">予約日: </p>
          <p class="modal-reserve-part">時間: </p>
          <p>上記の予約をキャンセルしてもよろしいですか？</p>
        </div>
        <div class="w-50 m-auto edit-modal-btn d-flex">
          <a class="js-modal-close btn btn-danger d-inline-block" href="">閉じる</a>
          <input type="hidden" class="cancel-modal-hidden" name="reserve-setting-id" value="">
          <input type="submit" class="btn btn-primary d-block" value="キャンセル">
          <!-- <input type="hidden" class="cancel-reserve-id" name="reserve_id" value="">
          <input type="hidden" class="cancel-reserve-date" name="reserve_date" value=""> -->
        </div>
      </div>
      {{ csrf_field() }}
    </form>
  </div>
</div>
@endsection
