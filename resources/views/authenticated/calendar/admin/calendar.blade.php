@extends('layouts.sidebar')
<!-- スクール予約確認 -->
@section('content')
<div class="w-75 m-auto confirm-area" style="align-items:center; justify-content:center;">
  <div class="border w-75 m-auto p-5" style="border-radius:5px; background:#FFF;">
    <p class="text-center">{{ $calendar->getTitle() }}</p>
    <p>{!! $calendar->render() !!}</p>
  </div>
</div>
@endsection
