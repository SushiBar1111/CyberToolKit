<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\ToolController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;

Route::get('/', [ToolController::Class, 'DashboardView'])->name('dashboardView');;
Route::get('/register', [AuthController::class, 'showRegisterPage'])->name('register');
Route::post('/register', [AuthController::class, 'userRegister']);

Route::get('/login', [AuthController::class, 'showLoginPage'])->name('login');
Route::post('/login', [AuthController::class, 'userLogin'])->middleware('throttle:5,1'); //throttle buat user cmn bisa 5 attempt / menit

Route::get('/logout', [AuthController::class, 'logout']);
//Route::get('/dashboard', [ToolController::class, 'DashboardView'])->name('dashboardView');

Route::get('/tool/{id}', [ToolController::class, 'ToolView'])->name('tool');
Route::post('/tool/list', [ToolController::class, 'GetTool'])->name('searchTool');

Route::get('/exploreTool', [ToolController::class, 'exploreTool'])->name('exploreTool');
Route::get('forgot-password', [AuthController::class, 'forgotpassword']);

// rute yang user harus login dulu
Route::middleware(['auth'])->group(function(){
    Route::get('/bookmark', [BookmarkController::class, 'BookmarkPage'])->name('bookmarkPage'); //buat liat bookmark si user
    Route::post('/bookmark/add', [BookmarkController::class, 'addBookmark'])->name('addingBookmark'); //buat nambahin bookmark
    Route::post('/bookmark/delete', [BookmarkController::class, 'deleteBookmark'])->name('deletingBookmark'); //buat delete bookmark
    Route::get('/profile', [ProfileController::class, 'GetProfile'])->name('profile');
    Route::post('/profile/updateProfile', [ProfileController::class, 'updateProfile'])->name('updateProfile');
});

// rute yang bisa akses cuman si atmin
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'getAdminDashboard'])->name('dashboardAdmin');
    Route::post('/admin/deleteTool', [AdminController::class, 'deleteTool'])->name('deleteTool'); 
    Route::post('/admin/addTool', [AdminController::class, 'addTool'])->name('addTool');
    Route::get('/admin/listUser', [AdminController::class, 'getUserList'])->name('listUsers');
    Route::post('/admin/deleteUser', [AdminController::class, 'deleteUser'])->name('deleteUser');
    Route::get('/edit-tool/{tool_id}', [AdminController::class, 'editToolView'])->name('editToolView');
    Route::post('/edit-tool/{tool_id}', [AdminController::class, 'modifyTool'])->name('updateTool');
   
});
