<?php

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

Route::get('/', [App\Http\Controllers\PageController::class, 'posts']);
Route::get('/blog/{post}', [App\Http\Controllers\PageController::class, 'post'])->name('post');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//namespace backend, protected by auth and except show post
use App\Http\Controllers\Backend\PostController;
Route::resource('/posts', PostController::class)
    ->middleware('auth')
    ->except('show');
