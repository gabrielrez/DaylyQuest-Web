<?php

use App\Http\Controllers\CollectionController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => view('landing-page'));

Route::get('/register', fn() => view('auth.register'));
Route::post('/register', [UserController::class, 'store']);

Route::get('/login', fn() => view('auth.login'))->name('login');
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout']);

Route::get('/homepage', [HomepageController::class, 'index'])->middleware('auth');

Route::get('/collection', [CollectionController::class, 'index'])->middleware('auth');
Route::get('/collection/create', [CollectionController::class, 'create'])->middleware('auth');
Route::post('/collection', [CollectionController::class, 'store'])->middleware('auth');
