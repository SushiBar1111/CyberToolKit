<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    function GetProfile(Request $request){
        $user = Auth::user();

        $userData = [
            'username' => $user->username,
            'email' => $user->email,
        ];

        return view('profile', ['user' => $userData]);
    }
}
