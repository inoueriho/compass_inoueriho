<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormController extends Controller
{
    public function userValidates(PostRequest $request) {
  return view('login.login',['msg'=>'OK']);
}
    //
}
