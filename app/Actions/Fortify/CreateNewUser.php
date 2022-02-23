<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        $rule = [];
        if($input['type'] == 0)
        {
            $rule = Rule::unique('users')->where(function ($query) {
                return $query->where('type', 0);
            });
        }
        if($input['type'] == 1)
        {
            $rule = Rule::unique('users')->where(function ($query) {
                return $query->where('type', 1);
            });
        }
        if($input['type'] == 2)
        {
            $rule = Rule::unique('users')->where(function ($query) {
                return $query->where('type', 2);
            });
        }
        if($input['type'] == 3)
        {
            $rule = Rule::unique('users')->where(function ($query) {
                return $query->where('type', 3);
            });
        }
        Validator::make($input, [
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'confirmed',
                $rule
            ],
            'type' => [
                'required',
            ]
        ])->validate();

        return User::create([
            'email' => $input['email'],
            'type' => $input['type'],
            'password' => bcrypt("pwd123")
        ]);
    }
}
