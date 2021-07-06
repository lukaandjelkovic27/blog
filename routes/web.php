<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;

Auth::routes();

Route::get('/', [PageController::class, 'index']);

/*Route::middleware('auth')->group(function () {*/
Route::resource('/post', PostController::class);

Route::resource('/post/comment', \App\Http\Controllers\CommentController::class);
/*});*/
/*Route::get('/home', [App\Http\Controllers\PageController::class, 'index'])->name('home');*/
