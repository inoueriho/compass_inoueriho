@extends('layouts.sidebar')
<!-- スクール予約確認 -->
@section('content')
<div class="w-100 min-vh-100 d-flex" style="align-items:center; justify-content:center;">

  <div class="border m-auto w-75 content-box" style="border-radius:5px; background:#FFF;">
    <!-- <div class="w-100 p-5 calendar-area"> -->
    <p class="text-center calendar-day">{{ $calendar->getTitle() }}</p>
    <p>{!! $calendar->render() !!}</p>
  <!-- </div> -->
   <!-- 下部スペース -->
  <div class="dummy-space"></div>
  </div>
</div>
@endsection
