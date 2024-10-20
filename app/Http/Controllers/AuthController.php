<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    //function buat show register page
    function showRegisterPage(Request $request){
        return view('register');
    }
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
            $username = strip_tags($request->input('username')); // ini ngilangin tag2 HTML
            $email = filter_var($request->input('email'), FILTER_SANITIZE_EMAIL); // ini ngecek input di email apakah sesuai dengan email pada umumnya
            $password = Hash::make($request->password); // ya hash password

            User::create([
                'username' => $username,
                'email' => $email,
                'password' => $password,
                'role' => 'user',
            ]);
            return redirect()->route('login')->with('status', 'Registration successful. Please login.');
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
            return redirect()->route('login')->with('status', 'aduh kang email sama password harus diisi');
        }else{ //kalo gacor kang yaudah tinggal diliat ini email sama passwordnya ada trs bener ga brok akhh kasus mennn
            $credentials = [
                'email' => filter_var($request->input('email'), FILTER_SANITIZE_EMAIL), // ni di sanitasi dulu neh si email harus beneran email
                'password' => $request->input('password')
            ];
            if (Auth::attempt($credentials)) {
                // regenenarsi session id brok
                $request->session()->regenerate();
                
                $user = Auth::user();
                
                if($user->role == 'admin'){ // ni dia ngecek yg punyal credentials ini rolenya apa brok
                    return redirect()->route('admin.dashboard') //di-redirect ke dashboard khusus atmin
                }else{
                    return redirect()->route('dashboard')
                }
            }else{ // ini kalo autentikasi gagal
                return redirect()->back()->withErrors(['login' => 'The provided credentials do not match our records.']);
            }
        }
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
