<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>AtlasBulletinBoard</title>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300&family=Oswald:wght@200&display=swap" rel="stylesheet">
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body class="all_content">
  <div class="d-flex">
    <div class="sidebar">
      @section('sidebar')
      <a href="{{ route('top.show') }}">
        <div class="sidebar_link">
          <img class="icon" src="{{ asset('image/home.png') }}" style="filter: brightness(0) invert(1);" />
          <p>トップ</p>
        </div>
      </a>
      <a href="/logout">
        <div class="sidebar_link">
          <img class="icon" src="{{ asset('image/exit.png') }}" style="filter: brightness(0) invert(1);" />
          <p>ログアウト</p>
        </div>
      </a>
      <a href="{{ route('calendar.general.show',['user_id' => Auth::id()]) }}">
        <div class="sidebar_link">
          <img class="icon" src="{{ asset('image/calendar.png') }}" style="filter: brightness(0) invert(1);" />
          <p>スクール予約</p>
        </div>
      </a>
      <a href="{{ route('calendar.admin.show',['user_id' => Auth::id()]) }}">
        <div class="sidebar_link">
          @can ('admin_only')
          <img class="icon" src="{{ asset('image/approve.png') }}" style="filter: brightness(0) invert(1);" />
          <p>スクール予約確認</p>@endcan
        </div>
      </a>
      <a href="{{ route('calendar.admin.setting',['user_id' => Auth::id()]) }}">
        <div class="sidebar_link">
          @can ('admin_only')
          <img class="icon" src="{{ asset('image/calendar-lines-pen.png') }}" style="filter: brightness(0) invert(1);" />
          <p>スクール枠登録</p>@endcan
        </div>
      </a>
      <a href="{{ route('post.show') }}">
        <div class="sidebar_link">
          <img class="icon" src="{{ asset('image/comment-alt.png') }}" style="filter: brightness(0) invert(1);" />
          <p>掲示板</p>
        </div>
      </a>
      <a href="{{ route('user.show') }}">
        <div class="sidebar_link">
          <img class="icon" src="{{ asset('image/users-alt.png') }}" style="filter: brightness(0) invert(1);" />
          <p>ユーザー検索</p>
        </div>
      </a>
      @show
    </div>
    <div class="main-container">
      @yield('content')
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="{{ asset('js/register.js') }}" rel="stylesheet"></script>
  <script src="{{ asset('js/bulletin.js') }}" rel="stylesheet"></script>
  <script src="{{ asset('js/user_search.js') }}" rel="stylesheet"></script>
  <script src="{{ asset('js/calendar.js') }}" rel="stylesheet"></script>
</body>
</html>
