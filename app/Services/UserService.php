<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserService
{
    protected function defaultCollection(): array
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

    public function checkLimitCollections()
    {
        return Auth::user()->collections->count() >= 4;
    }
}
