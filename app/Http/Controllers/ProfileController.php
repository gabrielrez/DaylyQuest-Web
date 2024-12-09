<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ProfileController extends Controller
{
    protected $user_model;

    public function __construct(User $user)
    {
        $this->user_model = $user;
    }

    public function show(int $id): View|Response
    {
        $user = User::findOrFail($id);

        if ($user->id !== Auth::id()) {
            abort(404);
        }

        [
            $collections_qtd,
            $goals_qtd,
            $collections_completed,
            $goals_completed,
        ] = $user->calculateStatistics();

        return view('profile.profile', [
            'collections' => $collections_qtd,
            'goals' => $goals_qtd,
            'collections_completed' => $collections_completed,
            'goals_completed' => $goals_completed,
        ]);
    }

    public function edit(): View
    {
        return view('profile.edit');
    }
}
