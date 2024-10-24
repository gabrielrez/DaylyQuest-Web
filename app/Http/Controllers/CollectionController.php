<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    public function index()
    {
        return view('collection', [
            'goals' => Goal::all()
        ]);
    }
}
