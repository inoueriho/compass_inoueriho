<!-- スクール予約画面 -->
@extends('layouts.sidebar')

@section('content')
<div class="w-100 min-vh-100 d-flex" style="align-items:center; justify-content:center;">
  <div class="border w-75 m-auto content-box" style="border-radius:5px; background:#FFF;">
    <!-- <div class="w-100 p-5 calendar-area"> -->
      <p class="text-center calendar-day">{{ $calendar->getTitle() }}</p>
        {!! $calendar->render() !!}
      <div class="adjust-table-btn w-100 text-right">
      <input type="submit" class="btn btn-primary" value="予約する" form="reserveParts" onclick="return confirm('予約してよろしいですか？')">
    <!-- </div> -->
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
          <a class="close-btn btn btn-danger d-inline-block" href="">閉じる</a>
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
