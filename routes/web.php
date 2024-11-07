<?php

use App\Http\Controllers\CollectionController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;
use App\Http\Middleware\CheckCollectionDeadline;
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
    Route::get('/settings', [SettingsController::class, 'index']);

    Route::get('/profile/edit', [ProfileController::class, 'edit']);
    Route::patch('/user/{id}', [UserController::class, 'update']);
    Route::delete('/user/{id}', [UserController::class, 'destroy']);

    // Collections
    Route::resource('collection', CollectionController::class)->only(['create', 'store', 'show', 'destroy']);

    // Goals
    Route::prefix('goal')->middleware([CheckCollectionDeadline::class])->group(function () {
        Route::get('/create/{collection_id}', [GoalController::class, 'create']);
        Route::post('/{collection_id}', [GoalController::class, 'store']);
        Route::put('/complete/{goal}', [GoalController::class, 'setStatus']);
    });

    Route::delete('/goal/{goal_id}', [GoalController::class, 'destroy']);

    // Settings
    Route::prefix('settings')->group(function () {
        Route::get('/information', fn() => view('settings.information'));
        Route::get('/timezone', fn() => view('settings.timezone'));
        Route::get('/language', fn() => view('settings.language'));
        Route::get('/account/preferences', fn() => view('settings.account-preferences'));
        Route::get('/support', fn() => view('settings.support'));
    });
});
