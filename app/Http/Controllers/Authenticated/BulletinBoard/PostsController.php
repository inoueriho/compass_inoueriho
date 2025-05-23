<?php

namespace App\Http\Controllers\Authenticated\BulletinBoard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categories\MainCategory;
use App\Models\Categories\SubCategory;
use App\Models\Posts\Post;
use App\Models\Posts\PostComment;
use App\Models\Posts\Like;
use App\Models\Users\User;
use App\Http\Requests\BulletinBoard\PostFormRequest;
use Auth;

class PostsController extends Controller
{
    public function show(Request $request){
        // dd($request->all());
        $posts = Post::with('user', 'postComments','subCategories')->get();
        $categories = MainCategory::with('subCategories')->get();
        $like = new Like;
        $post_comment = new PostComment;
        $post_id = PostComment::get();
        // dd($categories);
        // dd($post_id);
        if(!empty($request->keyword)){
            $posts = Post::with('user', 'postComments')
            ->where('post_title', 'like', '%'.$request->keyword.'%')
            ->orWhere('post', 'like', '%'.$request->keyword.'%')->get();
        }else if($request->sub_category_posts){
            $sub_category_id = $request->sub_category_posts;
            // whereHasを使うことで、中間テーブルを介す
            // subCategoriesはPost.phpで書いているリレーション名
            // sub_category_idはpost_sub_categoriesテーブルのカラム名
            // function($query)でリレーション先の条件を定義する
            $posts = Post::with('user', 'postComments')->whereHas('subCategories', function($query) use ($sub_category_id) {
            $query->where('sub_category_id', $sub_category_id);})->get();
            // サブカテゴリーに該当するpostsを表示する
            // リクエストを送っただけで絞り込めてない
            // $sub_categories = $request->sub_category_posts;
            // $posts = Post::with('user', 'postComments')->get();
        }else if($request->like_posts){
            // ログインユーザーがいいねしてたら表示する
            $likes = Auth::user()->likePostId()->get('like_post_id');
            $posts = Post::with('user', 'postComments')->whereIn('id', $likes)->get();
        }else if($request->my_posts){
            // ログインユーザーが投稿してたら表示する
            $posts = Post::with('user', 'postComments')
            ->where('user_id', Auth::id())->get();
        }
        return view('authenticated.bulletinboard.posts', compact('posts', 'categories', 'like', 'post_comment'));
    }

    public function postDetail($post_id){
        $post = Post::with('user', 'postComments','subCategories')->findOrFail($post_id);
        // dd($post);
        return view('authenticated.bulletinboard.post_detail', compact('post'));
    }

    // 投稿画面表示　メインカテゴリーとサブカテゴリーの情報を送ってる
    public function postInput(){
        $main_categories = MainCategory::get();
        $sub_categories = SubCategory::get();
        // dd($sub_categories);
        return view('authenticated.bulletinboard.post_create', compact('main_categories', 'sub_categories'));
        // compactで変数を渡す
    }

    public function postCreate(PostFormRequest $request){
                             //↑ここにバリデーション記載しているページ記載
        $categories = MainCategory::with('subCategories')->get();
        $sub_category = $request->post_category_id;
        // dd($sub_category);
        $post = Post::create([
            'post_category_id' => SubCategory::get(),
            'user_id' => Auth::id(),
            'post_title' => $request->post_title,
            'post' => $request->post_body
        ]);
        // dd($post);
        // $validated = $request->validate([
        //     'post_category_id' => 'required | in_array:sub_categories',
        //     'post_title' => 'required | string | max:100',
        //     'post_body' => 'required | string | max:5000'
        // ]);
        $post = Post::findOrFail($post->id);
        $post->subCategories()->attach($sub_category);
        // postにsubCategoriesの$sub_categoryを紐づける
        // return view('authenticated.bulletinboard.post_create', compact('categories'));
        return redirect()->route('post.show');
    }

    public function postEdit(PostFormRequest $request){
                             //↑ここにバリデーション記載しているページ記載
        $user_id = Auth::id();
        Post::where('id', $request->post_id)->edit([
            'post_title' => $request->post_title,
            'post' => $request->post_body,
        ]);
        return redirect()->route('post.detail', ['id' => $request->post_id]);
    }

    public function postDelete($id){
        $user_id = Auth::id();
        Post::findOrFail($id)->delete();
        return redirect()->route('post.show');
    }
    public function mainCategoryCreate(PostFormRequest $request){
        MainCategory::create(['main_category' => $request->main_category_name]);
        return redirect()->route('post.input');
    }
    public function subCategoryCreate(PostFormRequest $request){
        $validated = $request->validate([
            'sub_category_name' => 'string|max:100|unique:sub_categories,sub_category'
        ]);
        $main_categories = MainCategory::get();
        // dd($main_categories);
        // dd($request);
        SubCategory::create([
            'main_category_id' => $request->main_category_id,
            'sub_category' => $request->sub_category_name
        ]);
        return redirect()->route('post.input');
    }

    public function commentCreate(PostFormRequest $request){
                                //↑ここにバリデーション記載しているページ記載
        // $validated = $request->validate([
        //     'comment' => ' required | string | max:250 '
        // ]);
        PostComment::create([
            'post_id' => $request->post_id,
            'user_id' => Auth::id(),
            'comment' => $request->comment
        ]);
        return redirect()->route('post.detail', ['id' => $request->post_id]);
    }


    public function myBulletinBoard(){
        $posts = Auth::user()->posts()->get();
        $like = new Like;
        return view('authenticated.bulletinboard.post_myself', compact('posts', 'like'));
    }

    public function likeBulletinBoard(){
        $like_post_id = Like::with('users')->where('like_user_id', Auth::id())->get('like_post_id')->toArray();
        $posts = Post::with('user')->whereIn('id', $like_post_id)->get();
        $like = new Like;
        return view('authenticated.bulletinboard.post_like', compact('posts', 'like'));
    }

    public function postLike(Request $request){
        $user_id = Auth::id();
        $post_id = $request->post_id;
        // いいね登録
        $like = new Like;
        $like->like_user_id = $user_id;
        $like->like_post_id = $post_id;
        $like->save();

        // 最新のいいね数を取得
        $likes_count = Like::where('like_post_id',$post_id)->count();

        // return response()->json(['success' => true, 'likes_count' => $likes_count]);
        return response()->json(['likes_count' => Like::where('like_post_id', $post_id)->count()]);
    }

    public function postUnLike(Request $request){
        $user_id = Auth::id();
        $post_id = $request->post_id;

        $like = new Like;

        Like::where('like_user_id', $user_id)
             ->where('like_post_id', $post_id)
             ->delete();
        $likes_count = Like::where('like_post_id',$post_id)->count();

        // return response()->json(['success' => true, 'likes_count' => $likes_count]);
        return response()->json(['likes_count' => Like::where('like_post_id', $post_id)->count()]);

    }
}
