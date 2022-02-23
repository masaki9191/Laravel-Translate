<?php

namespace App\Http\Controllers\Profile;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class ClientProfileController extends Controller
{
    public function create()
    {
        return view('profile.client.create');
    }
    public function store(Request $request)
    {
        $rule = [
            'surname' => 'required',
            'lastname' => 'required',
            'seiname' => 'required',
            'meiname' => 'required',
            'password' => [
                'required',
                'string',
                'min:8',             // must be at least 10 characters in length
                'regex:/[a-z]/',      // must contain at least one lowercase letter
                'regex:/[0-9]/',      // must contain at least one digit
                'confirmed'
            ],
        ];
        $validatedData = $request->validate($rule);

        $validatedData['password'] = bcrypt($validatedData['password']);

        $id = auth()->id();
        $user = User::where('id', $id);
        $user->update($validatedData);

        return view('profile.client.thanks');
    }
    public function update_basic_get()
    {
        return view('profile.client.basic');
    }
    public function update_basic(Request $request)
    {
        $rule = [
            'surname' => 'required',
            'lastname' => 'required',
            'seiname' => 'required',
            'meiname' => 'required',
            'password' => [
                'required',
                'string',
                'min:8',             // must be at least 10 characters in length
                'regex:/[a-z]/',      // must contain at least one lowercase letter
                'regex:/[0-9]/',      // must contain at least one digit
                'confirmed'
            ],
        ];
        $validatedData = $request->validate($rule);

        $validatedData['password'] = bcrypt($validatedData['password']);

        $id = auth()->id();
        $user = User::where('id', $id);
        $user->update($validatedData);

        return view('profile.client.update_thanks');
    }
}
