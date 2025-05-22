@extends('layouts.sidebar')
<!-- スクール予約詳細確認 -->
@section('content')
<div class="vh-100 d-flex" style="align-items:center; justify-content:center;">
  <div class="text-center w-75"> <!-- 中央寄せ全体ラップ -->
    <p class="detail_calendar mb-3">
      <span>{{ $date }}日</span><span class="ml-3">{{ $part }}部</span>
    </p>
  <div class="border w-100 calendar-area" style="border-radius:5px; background:#FFF;">
    <!-- m-autoとw-50 消した↑ -->

  <div class=" h-75 m-auto">
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
</div>
@endsection
