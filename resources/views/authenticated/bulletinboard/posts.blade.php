@extends('layouts.sidebar')

@section('content')
<div class="board_area w-100 border m-auto d-flex">
  <div class="post_view w-75 mt-5">
    <p class="w-75 m-auto">投稿一覧</p>
    @foreach($posts as $post)
    <div class="post_area border w-75 m-auto p-3">
      <p><span>{{ $post->user->over_name }}</span><span class="ml-3">{{ $post->user->under_name }}</span>さん</p>
      <p><a href="{{ route('post.detail', ['id' => $post->id]) }}">{{ $post->post_title }}</a></p>
      <div class="post_bottom_area d-flex">
        <div class="d-flex post_status">
          <div>
            <p class="mr-5">
            <i class="fa fa-comment" comment_id="{{ $post->id }}"></i>
            {{ $post->commentCounts($post->id) }}
            </p>
          </div>
          <!-- <div>
            @if(Auth::user()->is_Like($post->id))
            <p class="m-0"><i class="fas fa-heart un_like_btn" post_id="{{ $post->id }}"></i>{{ $like->likeCounts($post->id) }}</p>
            @else
            <p class="m-0"><i class="fas fa-heart like_btn" post_id="{{ $post->id }}"></i>{{ $like->likeCounts($post->id) }}</p>
            @endif
          </div> -->
          <p class="m-0">
            @if(Auth::user()->is_Like($post->id))
            <!-- text-dangerでいろを赤くする -->
            <i class="fas fa-heart un_like_btn text-danger" post_id="{{ $post->id }}"></i>
            @else
            <i class="fas fa-heart like_btn" post_id="{{ $post->id }}"></i>
            @endif
            <span class="like_counts{{ $post->id }}">{{ $post->likeCounts() }}</span>
          </p>

        </div>
      </div>
    </div>
    @endforeach
  </div>
  <div class="other_area border w-25">
    <div class="border m-4">
      <div class=""><a href="{{ route('post.input') }}">投稿</a></div>
      <div class="">
        <input type="text" placeholder="キーワードを検索" name="keyword" form="postSearchRequest">
        <input type="submit" value="検索" form="postSearchRequest">
      </div>
      <input type="submit" name="like_posts" class="category_btn" value="いいねした投稿" form="postSearchRequest">
      <input type="submit" name="my_posts" class="category_btn" value="自分の投稿" form="postSearchRequest">
      <ul>
        @foreach($categories as $category)
        <li class="main_categories" category_id="{{ $category->id }}">
          <span>{{ $category->main_category }}<span>
            <ul>
              @foreach($category->subCategories as $sub_category)
              <li class="sub_categories" >
                <button type="hidden" name="sub_category_posts" class="category_btn" value="{{$sub_category->id}}" form="postSearchRequest">
                  {{$sub_category->sub_category}}
                </button>
              </li>
              @endforeach
            </ul>
        </li>
        @endforeach
      </ul>
    </div>
  </div>
  <form action="{{ route('post.show') }}" method="get" id="postSearchRequest"></form>
</div>
@endsection
