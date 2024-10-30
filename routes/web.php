<?php

use App\Http\Controllers\CollectionController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\NoCache;

Route::get('/', fn() => view('landing-page'));

Route::get('/register', fn() => view('auth.register'));
Route::post('/register', [UserController::class, 'store']);

Route::get('/login', fn() => view('auth.login'))->name('login');
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout']);

Route::middleware(['auth', NoCache::class])->group(function () {
    Route::get('/homepage', [HomepageController::class, 'index']);
    Route::get('/profile', [ProfileController::class, 'index']);

    // Collections
    Route::resource('collection', CollectionController::class)->only(['create', 'store', 'show']);

    // Goals
    Route::get('/goal/create/{collection_id}', [GoalController::class, 'create']);
    Route::post('/goal/{collection_id}', [GoalController::class, 'store']);
    Route::put('/goal/complete/{goal}', [GoalController::class, 'setStatus']);
});
