<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function store()
    {
        dd(request()->all());
    }

    public function login()
    {
        dd(request()->all());
    }
}
