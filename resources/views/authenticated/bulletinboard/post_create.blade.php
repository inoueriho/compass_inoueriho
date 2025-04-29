@extends('layouts.sidebar')

@section('content')
<div class="post_create_container d-flex">
  <div class="post_create_area border w-50 m-5 p-5">
    <div class="">
      <p class="mb-0">カテゴリー</p>
      <select class="w-100" form="postCreate" name="post_category_id">
        @foreach($main_categories as $main_category)
        <optgroup label="{{ $main_category->main_category }}">
          @foreach($sub_categories as $sub_category)
          @if($sub_category->main_category_id == $main_category->id)
          <option value="{{ $sub_category->id }}">{{ $sub_category->sub_category }}</option>
          @endif
        @endforeach
        </optgroup>
        @endforeach
      </select>
    </div>
    <div class="mt-3">
      @if ($errors->has('post_title'))
        <p class="text-danger">{{$errors->first('post_title')}}</p>
      @endif
      <p class="mb-0">タイトル</p>
      <input type="text" class="w-100" form="postCreate" name="post_title" value="{{ old('post_title') }}">
    </div>
    <div class="mt-3">
      @if ($errors->has('post_body'))
        <p class="text-danger">{{$errors->first('post_body')}}</p>
      @endif
      <p class="mb-0">投稿内容</p>
      <textarea class="w-100" form="postCreate" name="post_body">{{ old('post_body') }}</textarea>
    </div>
    <div class="mt-3 text-right">
      <input type="submit" class="btn btn-primary" value="投稿" form="postCreate">
    </div>
    <form action="{{ route('post.create') }}" method="post" id="postCreate">{{ csrf_field() }}</form>
  </div>
  <div class="w-25 ml-auto mr-auto">
    @can ('admin_only')
    <div class="category_area mt-5 p-5">
      <!-- メインカテゴリー追加 -->
      <div class="main_category">
          @if($errors->has('main_category_name')) <span class="text-danger">{{ $errors->first('main_category_name') }}</span> @endif
        <p class="m-0">メインカテゴリー</p>
        <form action="{{ route('main.category.create') }}" method="post" id="mainCategoryRequest">{{ csrf_field() }}</form>
        <input type="text" class="w-100" name="main_category_name" form="mainCategoryRequest">
        <input type="submit" value="追加" class="w-100 btn btn-primary p-0" form="mainCategoryRequest">
      </div>
      <!-- サブカテゴリー追加 -->
       <div class="sub_category">
          @if($errors->has('sub_category_name')) <span class="text-danger">{{ $errors->first('sub_category_name') }}</span> @endif
          <p class="m-0">サブカテゴリー</p>
          <!-- 登録されているメインカテゴリーから選択する -->
          <select type="text" class="w-100" form="subCategoryRequest" name="main_category_id">
            @foreach($main_categories as $main_category)
            <option label="{{ $main_category->main_category }}" value="{{$main_category->id}}"></option>
            @endforeach
          </select>
          <!-- サブカテゴリーの入力 -->
          <input type="text" class="w-100" name="sub_category_name" form="subCategoryRequest">
          <form action="{{ route('sub.category.create') }}" method="post" id="subCategoryRequest">{{ csrf_field() }}</form>
          <input type="submit" value="追加" class="w-100 btn btn-primary p-0" form="subCategoryRequest">
        </div>
    </div>
    @endcan
  </div>
</div>
@endsection
