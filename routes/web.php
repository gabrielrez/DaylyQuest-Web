<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing-page');
});

Route::get('/homepage', function () {
    $goals = [
        [
            'title' => 'Teste',
            'body' => 'daldede',
        ],
    ];

    return view('homepage', ['goals' => $goals]);
});
