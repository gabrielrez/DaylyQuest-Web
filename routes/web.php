<?php

use App\Http\Controllers\CollectionController;
use App\Http\Controllers\HomepageController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => view('landing-page'));

Route::get('/register', fn() => view('auth.register'));
Route::get('/login', fn() => view('auth.login'));

Route::get('/homepage', [HomepageController::class, 'index']);
Route::get('/collection', [CollectionController::class, 'index']);
