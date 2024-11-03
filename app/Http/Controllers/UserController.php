<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function store()
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

    public function createDefaultCollections(User $user)
    {
        $default_collections = [
            [
                'title' => 'Daily Goals',
                'description' => 'The best way to achieve your long-term goals is to stay consistent every day',
                'deadline' => now()->addDay()->setTime(0, 1),
                'cyclic' => 1,
                'status' => 0,
                'points' => 0,
            ]
        ];

        foreach ($default_collections as $collection_data) {
            $user->collections()->create($collection_data);
        }
    }

    public function login()
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

    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }

    public function update($id)
    {
        $user = User::findOrFail($id);

        request()->validate([
            'name' => ['required', 'min:3', 'max:28'],
            'nickname' => ['required', 'unique:users,nickname,' . $user->id, 'max:18'],
            'profile-picture' => ['nullable', 'image', 'max:2048'],
        ]);

        if (request()->hasFile('profile-picture')) {
            $path = request()->file('profile-picture')->store('profile-pictures', 'public');
            $user->profile_picture = $path;
        }

        $user->update([
            'name' => request('name'),
            'nickname' => request('nickname'),
        ]);

        return redirect('/profile');
    }
}
