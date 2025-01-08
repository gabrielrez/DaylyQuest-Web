<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserService
{
    protected static function defaultCollection(): array
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

    public static function createDefaultCollections(User $user): void
    {
        $default_collections = self::defaultCollection();

        foreach ($default_collections as $collection) {
            $user->collections()->create($collection);
        }
    }

    public static function checkLimitCollections()
    {
        return Auth::user()->collections->count() >= 4;
    }
}
