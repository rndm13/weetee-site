<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ForumController;

Route::get('/', [HomeController::class, 'show'])->name('index');
Route::get('/post/create', [PostController::class, 'create_form'])->name('post.create_form');
Route::post('/post/create', [PostController::class, 'create'])->name('post.create');

Route::get('/post/edit/{id}', [PostController::class, 'edit_form'])->name('post.edit_form');
Route::put('/post/edit/{id}', [PostController::class, 'edit'])->name('post.edit');
Route::delete('/post/edit/{id}', [PostController::class, 'delete'])->name('post.delete');

Route::get('/post/{id}', [PostController::class, 'show'])->name('post.show');


Route::get('/forum', [ForumController::class, 'show'])->name('forum.index');

Route::get('/login', [AccountController::class, 'login_form'])->name('account.login_form');
Route::get('/register', [AccountController::class, 'register_form'])->name('account.register_form');
Route::post('/login', [AccountController::class, 'login'])->name('account.login');
Route::post('/register', [AccountController::class, 'register'])->name('account.register');
Route::get('/logout', [AccountController::class, 'logout'])->name('account.logout');
