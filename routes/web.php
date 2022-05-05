<?php

use App\Http\Controllers\Mypage\LoginController;
use App\Http\Controllers\Mypage\PostManageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SignupController;
use App\Http\Middleware\PostShowLimit;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [PostController::class, 'index']);
Route::get('posts/{post}', [PostController::class, 'show'])
    ->name('posts.show');
    // ->middleware(PostShowLimit::class);

Route::get('signup', [SignupController::class, 'index']);
Route::post('signup', [SignupController::class, 'store']);

Route::get('mypage/login', [LoginController::class, 'index'])->name('login');
Route::post('mypage/login', [LoginController::class, 'login']);

Route::middleware('auth')->group(function () {
    Route::get('mypage/posts', [PostManageController::class, 'index'])->name('mypage.posts');
    Route::get('mypage/posts/create', [PostManageController::class, 'create'])->name('posts.create');
    Route::post('mypage/posts/create', [PostManageController::class, 'store'])->name('posts.store');
    Route::get('mypage/posts/edit/{post}', [PostManageController::class, 'edit'])->name('posts.edit');
    Route::post('mypage/posts/edit/{post}', [PostManageController::class, 'update']);
    Route::delete('mypage/posts/delete/{post}', [PostManageController::class, 'destroy'])->name('posts.delete');
    Route::post('mypage/logout', [LoginController::class, 'logout'])->name('logout');
});