<?php

use App\Http\Controllers\Post\PostController;
use App\Http\Controllers\Post\PostPointsController;
use App\Models\Post;
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

Route::get('/', function () {
    return view('welcome');
});


Route::resource('/posts' , \App\Http\Controllers\Post\PostController::class)->middleware('auth');
Route::resource('/posts/{post}/points' , App\Http\Controllers\Post\PostPointsController::class)
    ->middleware('auth');

Route::get('new_user', function(){
    // return User::factory()->create()->id;

    return Post::with('points')->get();
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Route::patch('/posts/{post}/points' , [App\Http\Controllers\Post\PostPointsController::class, 'store'])->middleware('auth');
