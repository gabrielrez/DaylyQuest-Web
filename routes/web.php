<?php

use App\Http\Controllers\HomepageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing-page');
});

Route::get('/homepage', [HomepageController::class, 'index']);
