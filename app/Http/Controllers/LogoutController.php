<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{

    public function out(Request $request)
    {
        if($request->has('email') == false)
        {
            return back()->with('status', 'error');
        }
        else{
            $email = $request->email;
            if (Auth::check()) {
                if(Auth::user()->email == $email){
                    //$this->exit_service();
                    Auth::logout();
                    $request->session()->invalidate();
                    $request->session()->regenerateToken();
                    return view('logout.thanks');
                }
            }
        }
        return back()->with('status', 'error');
    }
    public function exit_serivce()
    {
        $id = auth()->user()->id;
        $type = auth()->user()->type;
        if($type ==0 ){
            $user = User::where('id', $id);
            $user->delete();
        }

    }
}
