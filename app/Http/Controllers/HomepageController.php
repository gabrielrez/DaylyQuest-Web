<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    public function index()
    {
        return view('homepage', [
            'collections' => Collection::all()
        ]);
    }
}
