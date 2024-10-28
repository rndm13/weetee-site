<?php

use App\Http\Controllers;
use App\Http\Controllers\DocumentationController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

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

Route::get('/account/confirm/{email}/{token}', [AccountController::class, 'account_confirmation'])->name('account.confirm');

Route::get('/logout', [AccountController::class, 'logout'])->name('account.logout');
Route::get('/profile/{id}', [AccountController::class, 'profile'])->name('account.profile');

Route::post('/account/edit/{id}', [AccountController::class, 'edit_account'])->name('account.edit');
Route::post('/account/edit-password/{id}', [AccountController::class, 'change_password_account'])->name('account.change_password');
Route::post('/account/delete/{id}', [AccountController::class, 'delete_account'])->name('account.delete');
Route::post('/account/ban/{id}', [AccountController::class, 'ban_account'])->name('account.ban');

Route::post('/comment/create/{post_id}', [CommentController::class, 'create'])->name('comment.create');
Route::post('/comment/edit/{id}', [CommentController::class, 'edit'])->name('comment.edit');
Route::post('/comment/delete/{id}', [CommentController::class, 'delete'])->name('comment.delete');

Route::get('/account/report/{id}', [ReportController::class, 'create_form'])->name('account.report_form');
Route::post('/account/report/{id}', [ReportController::class, 'create'])->name('account.report');

Route::middleware("can:admin-dashboard")->group(function () {
    Route::get('/admin', [AdminDashboardController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/users', [AdminDashboardController::class, 'users'])->name('admin.users');
    Route::get('/admin/reports', [AdminDashboardController::class, 'reports'])->name('admin.reports');
    Route::get('/admin/report/details/{id}', [ReportController::class, 'details'])->name('admin.report_details');
    Route::post('/admin/report/resolve/{id}', [ReportController::class, 'resolve'])->name('admin.report_resolve');
    Route::post('/admin/report/reply/{id}', [ReportController::class, 'reply'])->name('admin.report_reply');

    Route::get('/admin/categories', [AdminDashboardController::class, 'categories'])->name('admin.categories');
    Route::post('/admin/category/save', [AdminDashboardController::class, 'category_save'])->name('admin.category_save');
    Route::post('/admin/category/delete/{id}', [AdminDashboardController::class, 'category_delete'])->name('admin.category_delete');

    Route::get('/admin/posts', [AdminDashboardController::class, 'posts'])->name('admin.posts');
    Route::get('/admin/documentations', [AdminDashboardController::class, 'documentations'])->name('admin.documentations');
    Route::get('/admin/documentation/create', [DocumentationController::class, 'create_form'])->name('admin.documentation.create');
    Route::get('/admin/documentation/edit/{id}', [DocumentationController::class, 'edit_form'])->name('admin.documentation.edit');
    Route::post('/admin/documentation/save', [DocumentationController::class, 'save'])->name('admin.documentation.save');
    Route::post('/admin/documentation/delete/{id}', [DocumentationController::class, 'delete'])->name('admin.documentation.delete');

    Route::post('/admin/documentation/upload-asset/{doc_id}', [DocumentationController::class, 'upload_asset'])->name('admin.documentation.upload_asset');
    Route::post('/admin/documentation/delete-asset/{id}', [DocumentationController::class, 'delete_asset'])->name('admin.documentation.delete_asset');

    Route::get('/admin/translations', [AdminDashboardController::class, 'translations'])->name('admin.translations');
});

Route::get('/documentation/asset/{doc_slug}/{asset_name}', [DocumentationController::class, 'get_asset'])->name('documentation.get_asset');
Route::get('/documentation/{slug?}/', [DocumentationController::class, 'show'])->name('documentation.show');
Route::get('/documentation/list-assets/{doc_id}', [DocumentationController::class, 'list_assets'])->name('documentation.list_assets');
