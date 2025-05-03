@extends('layouts.sidebar')
<!-- スクール予約詳細確認 -->
@section('content')
<div class="vh-100 d-flex" style="align-items:center; justify-content:center;">
  <p class="detail_calendar"><span>{{ $date }}日</span><span class="ml-3">{{ $part }}部</span></p>
  <div class="border w-75 m-auto calendar-area" style="border-radius:5px; background:#FFF;">
  <div class="w-50 h-75 m-auto">

    <div class="reserve_user-area">
      <table class="detail-table">
        <tr class="text-center calendar-item">
          <th class="w-25">ID</th>
          <th class="w-25">名前</th>
          <th class="w-25">予約場所</th>
        </tr>
        @foreach($reservePersons as $reserve)
        @foreach($reserve->users as $user)
          <tr class="text-center reserve-detail">
            <td class="w-25">{{ $user->id }}</td>
            <td class="w-25">{{ $user->over_name }} {{ $user->under_name }}</td>
            <td class="w-25">リモート</td>
          </tr>
        @endforeach
        @endforeach
      </table>
    </div>
  </div>
  </div>
</div>
@endsection
