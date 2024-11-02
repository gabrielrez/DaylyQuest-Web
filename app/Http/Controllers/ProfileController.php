<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile.profile');
    }

    public function edit()
    {
        return view('profile.edit');
    }
}
