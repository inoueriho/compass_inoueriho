<?php
namespace App\Searchs;

use App\Models\Users\User;

class SelectNameDetails implements DisplayUsers{

  // 改修課題：選択科目の検索機能
  public function resultUsers($keyword, $category, $updown, $gender, $role, $subjects){
    if(is_null($gender)){
      $gender = ['1', '2', '3'];
    }else{
      $gender = array($gender);
    }
    if(is_null($role)){
      $role = ['1', '2', '3', '4'];
    }else{
      $role = array($role);
    }
    $users = User::with('subjects')
    // キーワード検索（キーワードに入れた文字が名前に含まれてたら検索結果にでる）
    ->where(function($q) use ($keyword){
      $q->Where('over_name', 'like', '%'.$keyword.'%')
      ->orWhere('under_name', 'like', '%'.$keyword.'%')
      ->orWhere('over_name_kana', 'like', '%'.$keyword.'%')
      ->orWhere('under_name_kana', 'like', '%'.$keyword.'%');
      // OR検索
    })
    // 性別と権限検索（選択されたものに該当する人は検索結果にでる）
    ->where(function($q) use ($role, $gender){
      $q->whereIn('sex', $gender)
      ->whereIn('role', $role);
    })
    // 選択科目検索（チェックボックスで選んだ教科を選択している人は検索結果にでる）
    // whereHasでリレション先のテーブルの条件で検索する　
    ->whereHas('subjects', function($q) use ($subjects){
      $q->where('subject_users.id', $subjects);
    })
    ->orderBy('over_name_kana', $updown)->get();
    return $users;
  }

}
