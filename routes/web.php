<?php

use App\Http\Controllers\AdminsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
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

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/post/{post}', [PostController::class, 'show'])->name('post');

Route::middleware('auth')->group(function (){
    Route::get('/admin', [AdminsController::class, 'index'])->name('admin.index');

    Route::get('/admin/posts', [PostController::class, 'index'])->name('posts.index');

    Route::get('/admin/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/admin/posts', [PostController::class, 'store'])->name('posts.store');

    Route::get('/admin/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::patch('/admin/posts/{post}/update', [PostController::class, 'update'])->name('posts.update');

    Route::delete('/admin/posts/{post}/destory', [PostController::class, 'destroy'])->name('posts.destroy');

    Route::get('/admin/users/{user}/profile', [UserController::class, 'show'])->name('users.profile.show');
    Route::put('/admin/users/{user}/update', [UserController::class, 'update'])->name('users.profile.update');
});

