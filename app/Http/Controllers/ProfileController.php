<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show($id)
    {
        $user = User::findOrFail($id);

        if ($user->id !== Auth::id()) {
            abort(404);
        }

        [
            $collections_qtd,
            $goals_qtd,
            $collections_completed,
            $goals_completed
        ] = $user->calculateStatistics();

        return view('profile.profile', [
            'collections' => $collections_qtd,
            'goals' => $goals_qtd,
            'collections_completed' => $collections_completed,
            'goals_completed' => $goals_completed,
        ]);
    }

    public function edit()
    {
        return view('profile.edit');
    }
}
