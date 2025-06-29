@extends('layouts.sidebar')
@section('content')
<div class="detail-wrapper d-flex">
  <div class="w-50 mt-5">
    <div class="m-3 detail_container">
      <div class="p-3">
        <div class="detail_inner_head">
          <!-- <p class="validation_message">タイトルは必ず入力してください。</p> -->
          <!-- <div class="post-sub_category">
            カテゴリー名
             foreachの記述忘れがちでエラーになるから注意
              $post->subCategoriesは「複数のSubCategoryモデル」を持っているので、個別に取り出さないとsub_categoryにアクセスできません。
             @foreach ($post->subCategories as $subCategory)
              {{ $subCategory->sub_category }}
             @endforeach
          </div> -->
          <!-- 左寄せ要素 -->
          <div class="head_left_group">
          @if ($post->subCategories->isNotEmpty())
          <div class="post-sub_category">
            @foreach ($post->subCategories as $subCategory)
            {{ $subCategory->sub_category }}
            @endforeach
          </div>
          @endif
          </div>
          <!-- ↓ログインユーザーにのみ表示させる -->
          @if(Auth::user()->id == $post->user_id)
          <!-- 右寄せ要素 -->
          <div class="head_right">
          {{ csrf_field() }}
          <div class="post_detail-btn">
            <span class="edit-modal-open" post_title="{{ $post->post_title }}" post_body="{{ $post->post }}" post_id="{{ $post->id }}">編集</span>
            <a class="delete-btn" href="{{ route('post.delete', ['id' => $post->id]) }}" onclick="return confirm('こちらの投稿を削除してもよろしいでしょうか？')">削除</a>
          </div>
          </div>
          @endif

        </div>

        <div class="contributor d-flex">
          <p>
            <span>{{ $post->user->over_name }}</span>
            <span>{{ $post->user->under_name }}</span>
            さん
          </p>
          <span class="ml-5">{{ $post->created_at }}</span>
        </div>
        <div class="detsail_post_title">{{ $post->post_title }}</div>
        <div class="mt-3 detsail_post">{{ $post->post }}</div>
      </div>
      <div class="p-3">
        <div class="comment_container">
          <span class="">コメント</span>
          @foreach($post->postComments as $comment)
          <div class="comment_area border-top">
            <p>
              <span>{{ $comment->commentUser($comment->user_id)->over_name }}</span>
              <span>{{ $comment->commentUser($comment->user_id)->under_name }}</span>さん
            </p>
            <p>{{ $comment->comment }}</p>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
  <div class="w-50 p-3">
    <div class="comment_container border m-5">
      <div class="comment_area p-3">
        @if($errors->has('comment')) <p class="text-danger">{{ $errors->first('comment') }}</p> @endif
        <p class="m-0">コメントする</p>
        <textarea class="w-100" name="comment" form="commentRequest"></textarea>
        <input type="hidden" name="post_id" form="commentRequest" value="{{ $post->id }}">
        <input type="submit" class="btn btn-primary" form="commentRequest" value="投稿">
        <form action="{{ route('comment.create') }}" method="post" id="commentRequest">{{ csrf_field() }}</form>
      </div>
    </div>
  </div>
</div>
<!-- モーダルの中身 -->
<div class="modal js-modal">
  <div class="modal__bg js-modal-close"></div>
  <div class="modal__content">
    <form action="{{ route('post.edit') }}" method="post">
      <div class="w-100">
        <div class="modal-inner-title w-50 m-auto">
          <input type="text" name="post_title" placeholder="タイトル" class="w-100">

        </div>
        <div class="modal-inner-body w-50 m-auto pt-3 pb-3">
          <textarea placeholder="投稿内容" name="post_body" class="w-100"></textarea>

        </div>
        <div class="w-50 m-auto edit-modal-btn d-flex">
          <a class="btn btn-danger close_btn d-inline-block" href="">閉じる</a>
          <input type="hidden" class="edit-modal-hidden" name="post_id" value="">
          <input type="submit" class="btn btn-primary edit-btn d-block" value="編集">
        </div>
      </div>
      {{ csrf_field() }}
    </form>
  </div>
</div>
@endsection
