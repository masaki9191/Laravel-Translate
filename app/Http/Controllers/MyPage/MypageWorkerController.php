<?php

namespace App\Http\Controllers\MyPage;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class MypageWorkerController extends Controller
{
    public function index(){
        $type = auth()->user()->type;
        if($type == 1)
            return view('mypage.worker.translation');
        if($type == 2)
            return view('mypage.worker.conversation');
        if($type == 3){
            return view('mypage.worker.interpretation');
        }
    }
}
