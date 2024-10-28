<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomepageController extends Controller
{
    public function index()
    {
        $collections = Collection::where('user_id', Auth::id())->get();

        return view('homepage', [
            'collections' => $collections
        ]);
    }
}
