<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //function buat show register page dan login page
    function showRegisterPage(){
        return view('register');
    }
    function showLoginPage(){
        return view('login');
    }

    // function buat register
    function userRegister(Request $request){
        // validasi input dulu
        $request->validate([
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
        ]);
         //klo sesuai baru masukin ke db
            $username = strip_tags($request->input('username')); // ini ngilangin tag2 HTML jadi pas di save di database dia ga ada script HTML
            $email = $request->input('email');
            $password = Hash::make($request->password); // ya hash password

            // more secure way
             $user = new User();
             $user->username = $username;
             $user->password = $password;
             $user->email = $email;
             $user->role = 'user';
             $user->save();

            return redirect()->route('login')->with('status', 'Registration successful. Please login.')->setStatusCode(200);
        }

    function userLogin(Request $request){
        // validasi input dulu
        $validation = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);
        $credentials = [
            'email' => $request->input('email'), 
            'password' => $request->input('password')
        ];
        if (Auth::attempt($credentials)) {
            // regenenarsi session id brok
            $request->session()->regenerate();
                
            $user = Auth::user();
                
            if($user->role === 'admin'){ // ni dia ngecek yg punyal credentials ini rolenya apa brok
                return redirect()->route('dashboardAdmin')->setStatusCode(200); //di-redirect ke dashboard khusus atmin
            }else{
                return redirect()->route('dashboardView')->setStatusCode(200);
            }
        }else{ // ini kalo autentikasi gagal
            return redirect()->back()->withErrors(['login' => 'The provided credentials do not match our records.'])->setStatusCode(401);
        }
    }

    function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

}