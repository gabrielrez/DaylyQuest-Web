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
                'limit_time' => now()->endOfDay(),
                'status' => 0,
                'points' => 0,
            ],
            [
                'title' => 'Monthly Goals',
                'description' => 'Big results come from small steps taken consistently each month.',
                'limit_time' => now()->endOfMonth(),
                'status' => 0,
                'points' => 0,
            ],
            [
                'title' => 'Yearly Goals',
                'description' => "A year from now, you'll wish you had started today.",
                'limit_time' => now()->endOfYear(),
                'status' => 0,
                'points' => 0,
            ],
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
                'email' => 'Ops, those credentials do not match'
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
}
