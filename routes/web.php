<?php

use Illuminate\Support\Facades\Route;
use app\Http\Controllers\AuthController;
Route::get('/', function () {
    return view('welcome');
});


Route::get('/register', function(){
    return view('register');
});

Route::post('/register', [AuthController::class, 'userRegister']);
Route::post('/login', [LoginController::class, 'login'])->middleware('throttle:5,1'); //throttle buat jadi user cmn bisa 5 attempt / menit
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');

