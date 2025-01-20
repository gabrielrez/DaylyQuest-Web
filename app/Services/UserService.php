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

    public static function updateStatisticsIfHigher(User $user, array $current_statistics): void
    {
        $current_statistics = [
            'collections_total' => $current_statistics['current_collections'],
            'goals_total' => $current_statistics['current_goals'],
            'collections_completed' => $current_statistics['current_collections_completed'],
            'goals_completed' => $current_statistics['current_goals_completed'],
        ];

        $updated_statistics = collect($current_statistics)->filter(function ($value, $key) use ($user) {
            return $value > ($user->statistics[$key] ?? 0);
        })->toArray();

        if (!empty($updated_statistics)) {
            $user->update(['statistics' => array_merge($user->statistics ?? [], $updated_statistics)]);
        }
    }
}
