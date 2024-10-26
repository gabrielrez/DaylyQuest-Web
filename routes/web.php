<?php

use App\Http\Controllers\CollectionController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => view('landing-page'));

Route::get('/register', fn() => view('auth.register'));
Route::post('/register', [UserController::class, 'store']);

Route::get('/login', fn() => view('auth.login'));
Route::post('/login', [UserController::class, 'login']);

Route::get('/homepage', [HomepageController::class, 'index']);

Route::get('/collection', [CollectionController::class, 'index']);
Route::get('/collection/create', [CollectionController::class, 'create']);
Route::post('/collection', [CollectionController::class, 'store']);
