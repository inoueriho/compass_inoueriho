<!-- スクール枠登録 -->
@extends('layouts.sidebar')
@section('content')
<div class="w-100 vh-100 d-flex" style="align-items:center; justify-content:center;">
  <div class="border w-75 m-auto calendar-area" style="border-radius:5px; background:#FFF;">
  <div class="w-100 border p-5">
    <p class="text-center">{{ $calendar->getTitle() }}</p>
    {!! $calendar->render() !!}
    <div class="adjust-table-btn m-auto text-right">
      <input type="submit" class="btn btn-primary" value="登録" form="reserveSetting" onclick="return confirm('登録してよろしいですか？')">
    </div>
  </div>
</div>
</div>
@endsection
