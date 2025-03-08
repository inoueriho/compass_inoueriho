<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormController extends Controller
{
  //
    public function userValidates(PostRequest $request) {
  return view('login.login',['msg'=>'OK']);
}
  //postのバリデーション
    public function postValidates(PostRequest $request) {
  return view('bulletinboard.post_detail',['msg'=>'OK']);
}

}
