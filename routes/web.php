<?php

use App\Http\Controllers\CollectionController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GoalController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\NoCache;

Route::get('/', fn() => view('landing-page'));

Route::get('/register', fn() => view('auth.register'));
Route::post('/register', [UserController::class, 'store']);

Route::get('/login', fn() => view('auth.login'))->name('login');
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout']);

Route::get('/homepage', [HomepageController::class, 'index'])->middleware(['auth', NoCache::class]);

Route::get('/collection/create', [CollectionController::class, 'create'])->middleware(['auth', NoCache::class]);
Route::get('/collection/{id}', [CollectionController::class, 'show'])->middleware(['auth', NoCache::class]);
Route::post('/collection', [CollectionController::class, 'store'])->middleware(['auth', NoCache::class]);

Route::get('/goal/create/{collection_id}', [GoalController::class, 'create'])->middleware(['auth', NoCache::class]);
Route::post('/goal/{collection_id}', [GoalController::class, 'store'])->middleware(['auth', NoCache::class]);
