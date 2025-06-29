@extends('layouts.sidebar')

@section('content')
<div class="search_content w-100 border d-flex">
  <div class="search_users_area">
    @foreach($users as $user)
    <div class="border one_person">
      <div>
        <span>ID : </span><span>{{ $user->id }}</span>
      </div>
      <div><span class="item">名前 : </span>
        <a href="{{ route('user.profile', ['id' => $user->id]) }}">
          <span>{{ $user->over_name }}</span>
          <span>{{ $user->under_name }}</span>
        </a>
      </div>
      <div>
        <span class="item">カナ : </span>
        <span>({{ $user->over_name_kana }}</span>
        <span>{{ $user->under_name_kana }})</span>
      </div>
      <div>
        @if($user->sex == 1)
        <span class="item">性別 : </span><span>男</span>
        @elseif($user->sex == 2)
        <span class="item">性別 : </span><span>女</span>
        @else
        <span class="item">性別 : </span><span>その他</span>
        @endif
      </div>
      <div>
        <span class="item">生年月日 : </span><span>{{ $user->birth_day }}</span>
      </div>
      <div>
        @if($user->role == 1)
        <span class="item">権限 : </span><span>教師(国語)</span>
        @elseif($user->role == 2)
        <span class="item">権限 : </span><span>教師(数学)</span>
        @elseif($user->role == 3)
        <span class="item">権限 : </span><span>講師(英語)</span>
        @else
        <span class="item">権限 : </span><span>生徒</span>
        @endif
      </div>
      <div>
        @if($user->role == 4)
        <span class="item">選択科目 :</span>
          @foreach($user->subjects as $subject)
        <span>{{ $subject->subject }}</span>
          @endforeach
        @endif
      </div>
    </div>
    @endforeach
  </div>
  <div class="user_search_area w-25 border">
    <p class="search">ユーザー検索</p>
    <div class="">
      <div>
        <input type="text" class="free_word" name="keyword" placeholder="キーワードを検索" form="userSearchRequest">
      </div>
      <div>
        <lavel class="search-label">カテゴリ</lavel>
        <select class="search-select" form="userSearchRequest" name="category">
          <option value="name">名前</option>
          <option value="id">社員ID</option>
        </select>
      </div>
      <div>
        <label class="search-label">並び替え</label>
        <select class="search-select" name="updown" form="userSearchRequest">
          <option value="ASC">昇順</option>
          <option value="DESC">降順</option>
        </select>
      </div>
      <div class="">
        <div class="m-0 search_conditions">
          <span>検索条件の追加</span>
        </div>
      </div>
      <div class="search_conditions_inner">
          <div>
            <label class="search-label">性別</label>
            <div class="search-sex">
            <span>男</span><input type="radio" name="sex" value="1" form="userSearchRequest">
            <span>女</span><input type="radio" name="sex" value="2" form="userSearchRequest">
            <span>その他</span><input type="radio" name="sex" value="3" form="userSearchRequest">
            </div>
          </div>
          <div>
            <label class="search-label">権限</label>
            <select name="role" form="userSearchRequest" class="engineer">
              <option selected disabled>----</option>
              <option value="1">教師(国語)</option>
              <option value="2">教師(数学)</option>
              <option value="3">教師(英語)</option>
              <option value="4" class="">生徒</option>
            </select>
          </div>
          <div class="selected_engineer">
            <label class="search-label">選択科目</label>
            <div class="search-subject">
            <span>国語</span><input type="checkbox" name="subjects[]" value="1" form="userSearchRequest">
            <span>数学</span><input type="checkbox" name="subjects[]" value="2" form="userSearchRequest">
            <span>英語</span><input type="checkbox" name="subjects[]" value="3" form="userSearchRequest">
            </div>
          </div>
        </div>
      <div>
        <input class="search_btn" type="submit" name="search_btn" value="検索" form="userSearchRequest">
      </div>
      <div class="search-reset">
        <input  type="reset" value="リセット" form="userSearchRequest">
      </div>
    </div>
    <form action="{{ route('user.show') }}" method="get" id="userSearchRequest"></form>
  </div>
</div>
@endsection
