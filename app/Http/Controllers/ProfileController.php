<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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

    public function updateProfile(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'new_password' => 'nullable|min:8|confirmed', // 'confirmed' untuk validasi password dan konfirmasinya
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Ambil user yang sedang login
        $user = Auth::user();

        // Update username dan email
        $user->username = strip_tags($request->input('username'));
        $user->email = strip_tags($request->input('email'));

        // Jika ada password baru, perbarui password
        if ($request->filled('new_password')) {
            $user->password = Hash::make($request->input('new_password'));
        }

        // Simpan perubahan
        $user->save();

        // Redirect kembali dengan pesan sukses
        return redirect()->route('profile')->with('status', 'Profile updated successfully!');
    }
}
