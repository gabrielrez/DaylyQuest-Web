<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show($id)
    {
        $user = User::findOrFail($id);

        [$collections_qtd, $goals_qtd] = $user->calculateStatistics();

        return view('profile.profile', [
            'collections' => $collections_qtd,
            'goals' => $goals_qtd,
        ]);
    }

    public function edit()
    {
        return view('profile.edit');
    }
}
