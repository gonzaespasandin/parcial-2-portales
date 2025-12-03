<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\EnsureUserIsAdmin;

Route::get('/', [\App\Http\Controllers\HomeController::class, 'home'])
    ->name('home');

Route::get('login', [\App\Http\Controllers\AuthController::class, 'showLogin'])
    ->name('auth.login.show')
    ->middleware('guest');

Route::post('login', [\App\Http\Controllers\AuthController::class, 'processLogin'])
    ->name('auth.login.process')
    ->middleware('guest');

Route::get('register', [\App\Http\Controllers\AuthController::class, 'showRegister'])
    ->name('auth.register.show')
    ->middleware('guest');

Route::post('register', [\App\Http\Controllers\AuthController::class, 'processRegister'])
    ->name('auth.register.process')
    ->middleware('guest');

Route::post('logout', [\App\Http\Controllers\AuthController::class, 'logout'])
    ->name('auth.logout')
    ->middleware('auth');

Route::get('news', [\App\Http\Controllers\NewsController::class, 'index'])
    ->name('news.index');
    
Route::get('news/create', [\App\Http\Controllers\NewsController::class, 'create'])
    ->name('news.create')
    ->middleware(EnsureUserIsAdmin::class);

Route::post('news/create', [\App\Http\Controllers\NewsController::class, 'store'])
    ->name('news.store')
    ->middleware(EnsureUserIsAdmin::class);

Route::get('news/{id}/edit', [\App\Http\Controllers\NewsController::class, 'edit'])
    ->name('news.edit')
    ->whereNumber('id')
    ->middleware(EnsureUserIsAdmin::class);

Route::post('news/{id}/edit', [\App\Http\Controllers\NewsController::class, 'update'])
    ->name('news.update')
    ->whereNumber('id')
    ->middleware(EnsureUserIsAdmin::class);

Route::get('news/{id}/delete', [\App\Http\Controllers\NewsController::class, 'delete'])
    ->name('news.delete')
    ->whereNumber('id')
    ->middleware(EnsureUserIsAdmin::class);

Route::post('news/{id}/delete', [\App\Http\Controllers\NewsController::class, 'destroy'])
    ->name('news.destroy')
    ->whereNumber('id')
    ->middleware(EnsureUserIsAdmin::class);

Route::get('news/{id}', [\App\Http\Controllers\NewsController::class, 'show'])
    ->name('news.show')
    ->whereNumber('id');

Route::get('admin', [\App\Http\Controllers\AdminController::class, 'index'])
    ->name('admin.index')
    ->middleware(EnsureUserIsAdmin::class);

Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'index'])
    ->name('profile.index')
    ->middleware('auth');

Route::get('profile/edit', [\App\Http\Controllers\ProfileController::class, 'edit'])
    ->name('profile.edit')
    ->middleware('auth');

Route::post('profile/edit', [\App\Http\Controllers\ProfileController::class, 'update'])
    ->name('profile.update')
    ->middleware('auth');