<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // function buat register
    function userRegister(Request $request){
        // validasi input dulu
        $validation = Validator::make($request->all(),
        [ //array of validation
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',

        ]);

        if($validation->fails()){ //kalo input ga sesuai return HTTP 400
            return response()->json($validation->errors(), 400);
        }else{ //klo sesuai baru masukin ke db
            $username = $request->username;
            $email = $request->email;
            $password = Hash::make($request->password);

            User::create([
                'username' => $username,
                'email' => $email,
                'password' => $password
            ])
        }
    }

    function userLogin(Request $request){
        // validasi input dulu
        $validation = Validator::make($request->all(),[
            'email' => 'required'|'email',
            'password' => 'required'|'min 8',
        ]);

        //cek validasinya gacor ga kang
        if($validation->fails()){
            return response()->json($validation->errors(), 400);
        }else{ //kalo gacor kang yaudah tinggal diliat ini email sama passwordnya ada trs bener ga brok akhh kasus mennn
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                // regenenarsi session id brok
                $request->session()->regenerate();
                
                $user = Auth::user();
                
                if($user->role == 'admin'){
                    return response()->json([
                        'message' => 'Login successful admin',
                    ], 200);
                }else{
                    return response()->json([
                        'message' => 'Login successful',
                    ], 200);
                }
            }else{ // ini kalo autentikasi gagal
                return response()->json(['error' => 'Email or password is incorrect'], 401);
            }
        }
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json(['message' => 'Logout successful'], 200);
    }
}
