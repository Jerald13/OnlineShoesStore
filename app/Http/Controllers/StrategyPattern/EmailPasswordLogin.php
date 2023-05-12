<?php

namespace App\Http\Controllers\StrategyPattern;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EmailPasswordLogin implements LoginStrategyInterface
{

    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $user = User::where('email', $email)->first();

        if($user == null){
            return false;
        }

        if(Hash::check($password, $user->password)){
            Auth::login($user);
        }else{
            return false;
        }

        return true;
    }
}
