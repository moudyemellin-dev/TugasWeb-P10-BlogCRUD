<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::get('/', function () {
    return redirect()->route('posts.index');
});

Route::resource('posts', PostController::class);

Route::get('/trash', [PostController::class, 'trash'])
    ->name('posts.trash');

Route::patch('/posts/{id}/restore', [PostController::class, 'restore'])
    ->name('posts.restore');

Route::delete('/posts/{id}/force-delete', [PostController::class, 'forceDelete'])
    ->name('posts.forceDelete');