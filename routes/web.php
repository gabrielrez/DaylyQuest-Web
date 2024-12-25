<?php

use App\Http\Controllers\CollectionController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\StepController;
use App\Http\Controllers\SupportController;
use App\Http\Middleware\CheckCollectionDeadline;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\NoCache;

Route::get('/', fn() => view('landing-page'));

Route::get('/register', fn() => view('auth.register'));
Route::post('/register', [UserController::class, 'store']);

Route::get('/login', fn() => view('auth.login'))->name('login');
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout']);

Route::post('/support-message', [SupportController::class, 'sendMessage']);

// Middleware Auth
Route::middleware(['auth', NoCache::class])->group(function () {
    Route::get('/homepage', [HomepageController::class, 'index']);
    Route::get('/settings', [SettingsController::class, 'index']);

    // User
    Route::get('/profile/edit', [UserController::class, 'edit']);
    Route::get('/profile/{id}', [UserController::class, 'show']);
    Route::patch('/user/{id}', [UserController::class, 'update']);
    Route::delete('/user/{id}', [UserController::class, 'destroy']);

    // Collections
    Route::resource('collection', CollectionController::class)->only(['create', 'store', 'show', 'update', 'destroy']);

    // Goals
    Route::get('/goal/create/{collection_id}', [GoalController::class, 'create']);
    Route::get('/goal/steps/{goal}', [GoalController::class, 'steps']);
    Route::post('/goal/{collection_id}', [GoalController::class, 'store']);
    Route::put('/goal/complete/{goal}', [GoalController::class, 'setStatus']);
    Route::delete('/goal/{goal_id}', [GoalController::class, 'destroy']);

    // Settings
    Route::get('settings/information', fn() => view('settings.information'));
    Route::get('settings/timezone', fn() => view('settings.timezone'));
    Route::get('settings/language', fn() => view('settings.language'));
    Route::get('settings/account/preferences', fn() => view('settings.account-preferences'));
    Route::get('settings/support', fn() => view('settings.support'));

    // Community
    // Route::get('/community', [CommunityController::class, 'index']);
});
