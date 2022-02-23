<?php

namespace App\Http\Controllers\MyPage;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class MypageClientController extends Controller
{
    public function index(){
        return view('mypage.client.translation');
    }
    public function change(Request $request){
        $type = $request->type;
        if($type == 1)
            return view('mypage.client.translation');
        if($type == 2)
            return view('mypage.client.conversation');
        if($type == 3)
            return view('mypage.client.interpretation');
    }
}
