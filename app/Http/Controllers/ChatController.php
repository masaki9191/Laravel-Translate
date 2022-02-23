<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ChatController extends Controller
{
    public function index($type,$id="")
    {
        $search_user = User::where('id', $id)->first();
        return view('chat.index',compact('search_user','type'));
    }
}
