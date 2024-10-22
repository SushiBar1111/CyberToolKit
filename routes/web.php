<?php

use Illuminate\Support\Facades\Route;
use app\Http\Controllers\AuthController;
use app\Http\Controllers\BookmarkController;
use app\Http\Controllers\ToolController;
use app\Http\Controllers\AdminController;

Route::get('/register', [AuthController::class, 'showRegisterPage'])->name('register');
Route::post('/register', [AuthController::class, 'userRegister']);

Route::get('/login',[AuthController::class], 'showLoginPage')->name('login');
Route::post('/login', [AuthController::class, 'userLogin'])->middleware('throttle:5,1'); //throttle buat user cmn bisa 5 attempt / menit

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');
Route::get('/dashboard', [ToolController::class, 'dashboard']);

Route::get('/tool', [ToolController::class, 'ToolView'])->name('Tools');
Route::get('/tool/name=', [ToolController::class, 'GetTool']);

// rute yang user harus login dulu
Route::middleware(['auth'])->group(function(){
    Route::get('/bookmark', [BookmarkController::class, 'BookmarkPage'])->name('bookmark'); //buat liat bookmark si user
    Route::post('/bookmark', [BookmarkController::class, 'addBookmark']); //buat nambahin bookmark
});

// rute yang bisa akses cuman si atmin
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('dashboardAdmin');
    Route::post('/admin/deleteTool', [ToolController::class, 'deleteTool']); 
    Route::post('/admin/addTool', [AdminController::class, 'addTool']);
   
});
