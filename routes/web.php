<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\ToolController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;


Route::get('/register', [AuthController::class, 'showRegisterPage'])->name('register');
Route::post('/register', [AuthController::class, 'userRegister']);

Route::get('/login', [AuthController::class, 'showLoginPage'])->name('login');
Route::post('/login', [AuthController::class, 'userLogin'])->middleware('throttle:5,1'); //throttle buat user cmn bisa 5 attempt / menit

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');
Route::get('/dashboard', [ToolController::class, 'DashboardView'])->name('dashboardView');

Route::get('/tool', [ToolController::class, 'ToolView'])->name('tool');
Route::post('/tool/list', [ToolController::class, 'GetTool'])->name('searchTool');

// rute yang user harus login dulu
Route::middleware(['auth'])->group(function(){
    Route::get('/bookmark', [BookmarkController::class, 'BookmarkPage'])->name('bookmark'); //buat liat bookmark si user
    Route::post('/bookmark', [BookmarkController::class, 'addBookmark'])->name('addingBookmark'); //buat nambahin bookmark
    Route::get('/profile', [ProfileController::class, 'GetProfile'])->name('profile');
});

// rute yang bisa akses cuman si atmin
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'getAdminDashboard'])->name('dashboardAdmin');
    Route::post('/admin/deleteTool', [AdminController::class, 'deleteTool'])->name('deleteTool'); 
    Route::post('/admin/addTool', [AdminController::class, 'addTool'])->name('addTool');
    Route::get('/admin/listUser', [AdminController::class, 'getUserList'])->name('listUsers');
    Route::post('/admin/deleteUser', [AdminController::class, 'deleteUser'])->name('deleteUser');
   
});
