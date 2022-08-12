<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BlogController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::resource('blog', BlogController::class);

Route::get('/', [App\Http\Controllers\BlogController::class, 'index'])->name('home');
Route::post('/comment/{id}', [App\Http\Controllers\BlogController::class, 'comment'])->name('comment');
Route::get('/userBlog', [App\Http\Controllers\BlogController::class, 'currentUserBlog'])->name('currentUserBlog');
