<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\TimezoneService;
use App\Services\UserService;
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
    protected $user_service;

    public function __construct(UserService $user_service)
    {
        $this->user_service = $user_service;
    }

    public function show(int $id): View|Response
    {
        $user = User::findOrFail($id);

        if ($user->id !== Auth::id()) {
            abort(404);
        }

        UserService::updateStatisticsIfHigher($user, $user->calculateCurrentStatistics());

        return view('profile.profile', [
            'current_statistics' => $user->calculateCurrentStatistics(),
            'achievements' => $user->getAchievements($user->id),
        ]);
    }

    public function store(): RedirectResponse
    {
        $attributes = request()->validate([
            'name' => ['required', 'min:3', 'max:28'],
            'nickname' => ['required', 'unique:users,nickname', 'max:18'],
            'email' => ['required', 'email', 'max:254', 'unique:users,email'],
            'password' => ['required', Password::min(6)->max(18)->letters()->numbers(), 'confirmed'],
            'timezone' => ['required', 'in:' . implode(',', \DateTimeZone::listIdentifiers())],
        ]);

        $user = User::create($attributes);

        UserService::createDefaultCollections($user);

        TimezoneService::setTimezone($user->timezone);

        Auth::login($user);

        return redirect('/homepage');
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

    public function setTimezone(int $id): RedirectResponse
    {
        $user = User::findOrFail($id);

        request()->validate([
            'timezone' => ['in:' . implode(',', \DateTimeZone::listIdentifiers())],
        ]);

        $user->update([
            'timezone' => request('timezone'),
        ]);

        return redirect()->back();
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
