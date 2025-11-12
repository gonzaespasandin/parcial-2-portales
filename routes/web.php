<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\HomeController::class, 'home'])
    ->name('home');

Route::get('login', [\App\Http\Controllers\AuthController::class, 'show'])
    ->name('auth.login.show')
    ->middleware('guest');

Route::post('login', [\App\Http\Controllers\AuthController::class, 'process'])
    ->name('auth.login.process')
    ->middleware('guest');

Route::post('logout', [\App\Http\Controllers\AuthController::class, 'logout'])
    ->name('auth.logout')
    ->middleware('auth');

Route::get('news', [\App\Http\Controllers\NewsController::class, 'index'])
    ->name('news.index');
    
Route::get('news/create', [\App\Http\Controllers\NewsController::class, 'create'])
    ->name('news.create')
    ->middleware('auth');

Route::post('news/create', [\App\Http\Controllers\NewsController::class, 'store'])
    ->name('news.store')
    ->middleware('auth');

Route::get('news/{id}/edit', [\App\Http\Controllers\NewsController::class, 'edit'])
    ->name('news.edit')
    ->whereNumber('id')
    ->middleware('auth');

Route::post('news/{id}/edit', [\App\Http\Controllers\NewsController::class, 'update'])
    ->name('news.update')
    ->whereNumber('id')
    ->middleware('auth');

Route::get('news/{id}/delete', [\App\Http\Controllers\NewsController::class, 'delete'])
    ->name('news.delete')
    ->whereNumber('id')
    ->middleware('auth');

Route::post('news/{id}/delete', [\App\Http\Controllers\NewsController::class, 'destroy'])
    ->name('news.destroy')
    ->whereNumber('id')
    ->middleware('auth');

Route::get('news/{id}', [\App\Http\Controllers\NewsController::class, 'show'])
    ->name('news.show')
    ->whereNumber('id');