<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function create($type = null){
        if($type == null)
            return redirect()->route('welcome');
        if (Auth::check()) {
            Auth::logout();
        }
        return view('auth.login',compact('type'));
    }
    public function store(Request $request)
    {
        $credentials = $request->only('email', 'password', 'type');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('mypage');
        }

        return back()->withErrors([
            'email' => '提供された資格情報が当社の記録と一致しません。',
        ]);
    }
}
