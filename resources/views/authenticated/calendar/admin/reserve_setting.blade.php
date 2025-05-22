<!-- スクール枠登録 -->
@extends('layouts.sidebar')
@section('content')
<div class="w-100 min-vh-100 d-flex" style="align-items:center; justify-content:center;">
  <div class="border m-auto w-75 content-box" style="border-radius:5px; background:#FFF;">
  <!-- <div class="w-100 border p-5 calendar-area"> -->
    <p class="text-center calendar-day">{{ $calendar->getTitle() }}</p>
    {!! $calendar->render() !!}
    <div class="adjust-table-btn w-100 text-right">
      <input type="submit" class="btn btn-primary" value="登録" form="reserveSetting" onclick="return confirm('登録してよろしいですか？')">
    </div>
  <!-- </div> -->
</div>
</div>
@endsection
