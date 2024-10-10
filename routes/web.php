<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ForumController;

Route::get('/', [HomeController::class, 'show'])->name('index');
Route::get('/post/create', [PostController::class, 'create_form'])->name('post.create_form');
Route::post('/post/create', [PostController::class, 'create'])->name('post.create');

Route::get('/post/edit/{id}', [PostController::class, 'edit_form'])->name('post.edit_form');
Route::post('/post/edit/{id}', [PostController::class, 'edit'])->name('post.edit');
Route::post('/post/delete/{id}', [PostController::class, 'delete'])->name('post.delete');

Route::get('/post/view/{id}', [PostController::class, 'show'])->name('post.show');

Route::get('/forum', [ForumController::class, 'show'])->name('forum.index');

Route::get('/login', [AccountController::class, 'login_form'])->name('account.login_form');
Route::post('/login', [AccountController::class, 'login'])->name('account.login');

Route::get('/register', [AccountController::class, 'register_form'])->name('account.register_form');
Route::post('/register', [AccountController::class, 'register'])->name('account.register');

Route::get('/auth/google/redirect', [AccountController::class, 'google_redirect'])->name('account.google.redirect');
Route::get('/auth/google/callback', [AccountController::class, 'google_callback'])->name('account.google.callback');

Route::get('/logout', [AccountController::class, 'logout'])->name('account.logout');
Route::get('/profile/{id}', [AccountController::class, 'profile'])->name('account.profile');

Route::post('/account/edit/{id}', [AccountController::class, 'edit_account'])->name('account.edit');
Route::post('/account/edit-password/{id}', [AccountController::class, 'change_password_account'])->name('account.change_password');
Route::post('/account/delete/{id}', [AccountController::class, 'delete_account'])->name('account.delete');

Route::post('/comment/create/{post_id}', [CommentController::class, 'create'])->name('comment.create');
Route::post('/comment/edit/{id}', [CommentController::class, 'edit'])->name('comment.edit');
Route::post('/comment/delete/{id}', [CommentController::class, 'delete'])->name('comment.delete');

