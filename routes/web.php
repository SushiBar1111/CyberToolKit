<?php

use Illuminate\Support\Facades\Route;
use app\Http\Controllers\AuthController;
use app\Http\Controllers\BookmarkController;
use app\Http\Controllers\ToolController;

Route::get('/register', [AuthController::class, 'showRegisterPage']);
Route::post('/register', [AuthController::class, 'userRegister']);
Route::post('/login', [LoginController::class, 'login'])->middleware('throttle:5,1')->name('login'); //throttle buat jadi user cmn bisa 5 attempt / menit
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');
Route::get('/dashboard',[
    return view('dashboard');
]);

// rute yang user harus login dulu
Route::middleware(['auth'])->group(function(){
    Route::get('/bookmark', [BookmarkController::class, 'BookmarkPage']); //buat liat bookmark si user
    Route::post('/bookmark', [BookmarkController::class, 'addBookmark']); //buat nambahin bookmark

});
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index']);
    // Rute lain khusus admin
});
