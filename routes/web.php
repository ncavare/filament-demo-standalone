<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\EditPost;
use App\Http\Livewire\ListPost;

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

Route::get('', function () {
    return redirect('/posts');
});

Route::get('posts', ListPost::class)->name('posts.index');
Route::get('posts/create', EditPost::class)->name('posts.create');
Route::get('posts/{post}/edit', EditPost::class)->name('posts.edit');
