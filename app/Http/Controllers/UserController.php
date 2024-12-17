<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View as ViewView;

class UserController extends Controller
{
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

    public function store(): RedirectResponse
    {
        $attributes = request()->validate([
            'name' => ['required', 'min:3', 'max:28'],
            'nickname' => ['required', 'unique:users,nickname', 'max:18'],
            'email' => ['required', 'email', 'max:254', 'unique:users,email'],
            'password' => ['required', Password::min(6)->max(18)->letters()->numbers(), 'confirmed'],
        ]);

        $user = User::create($attributes);

        $this->createDefaultCollections($user);

        Auth::login($user);

        return redirect('/homepage');
    }

    public function defaultCollection(): array
    {
        return [
            [
                'title' => 'Daily Goals',
                'description' => 'The best way to achieve your long-term goals is to stay consistent every day',
                'deadline' => now()->addDay()->setTime(0, 1),
                'cyclic' => 1,
                'status' => 'inProgress',
                'points' => 0,
            ]
        ];
    }

    public function createDefaultCollections(User $user): void
    {
        $default_collections = $this->defaultCollection();

        foreach ($default_collections as $collection) {
            $user->collections()->create($collection);
        }
    }

    public function login(): RedirectResponse
    {
        $attributes = request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (!Auth::attempt($attributes)) {
            throw ValidationException::withMessages([
                'email' => 'Oops, those credentials do not match'
            ]);
        }

        request()->session()->regenerate();

        return redirect('/homepage');
    }

    public function edit(): View
    {
        return view('profile.edit');
    }

    public function update(int $id): RedirectResponse
    {
        $user = User::findOrFail($id);

        request()->validate([
            'name' => ['required', 'min:3', 'max:28'],
            'nickname' => ['required', 'unique:users,nickname,' . $user->id, 'max:18'],
            'bio' => ['required', 'max:120'],
            'profile-picture' => ['nullable', 'image', 'max:2048'],
        ]);

        if (request()->hasFile('profile-picture')) {
            $path = request()->file('profile-picture')->store('profile-pictures', 'public');
            $user->profile_picture = $path;
        }

        $user->update([
            'name' => request('name'),
            'nickname' => request('nickname'),
            'bio' => request('bio'),
        ]);

        return redirect('/profile/' . Auth::user()->id);
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();

        session()->forget('show_notice_modal');

        return redirect('/');
    }

    public function destroy(int $id): RedirectResponse
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return redirect('/')->with('status', 'Account deleted successfully.');
        } else {
            return redirect('/settings')->with('error', 'User not found.');
        }
    }
}
