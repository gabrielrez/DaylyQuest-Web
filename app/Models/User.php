<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'nickname',
        'bio',
        'email',
        'password',
        'profile_picture',
        'points',
        'timezone',
        'statistics',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'statistics' => 'array',
        ];
    }

    public function collections()
    {
        return $this->hasMany(Collection::class);
    }

    public function achievements()
    {
        return $this->belongsToMany(Achievement::class, 'user_achievements');
    }

    public function getAchievements($user_id): array
    {
        $user = User::findOrFail($user_id);

        $achievements = $user->achievements()
            ->orderByRaw("FIELD(type, 'beginner', 'productivity', 'collection', 'social')")
            ->get();

        return $achievements->toArray();
    }

    public function calculateGoalCompletionPercentageOverTime(): array
    {
        $goals_by_date = $this->collections->flatMap->goals->groupBy(fn($goal) => $goal->created_at->format('Y-m-d'));

        $percentages = [];

        foreach ($goals_by_date as $date => $goals) {
            $total_goals = count($goals);
            $completed_goals = count(array_filter($goals, fn($goal) => $goal->status === 'completed'));

            $percentage_completed = $total_goals > 0 ? ($completed_goals / $total_goals) * 100 : 0;

            $percentages[] = [
                'date' => $date,
                'percentage' => $percentage_completed
            ];
        }

        return $percentages;
    }


    public function calculateCurrentStatistics(): array
    {
        $current_collections = $this->collections->count();

        $current_goals = $this->collections->flatMap->goals->count();

        $current_collections_in_progress = $this->collections
            ->where('status', 'inProgress')
            ->count();

        $current_goals_in_progress = $this->collections->filter(function ($collection) {
            return $collection->goals->isNotEmpty() &&
                $collection->goals->every(fn($goal) => $goal->status === 'inProgress');
        })->count();

        $current_collections_completed = $this->collections->filter(function ($collection) {
            return $collection->goals->isNotEmpty() &&
                $collection->goals->every(fn($goal) => $goal->status === 'completed');
        })->count();

        $current_goals_completed = $this->collections->flatMap->goals
            ->where('status', 'completed')
            ->count();

        $current_collections_expired = $this->collections
            ->where('status', 'expired')
            ->count();

        return [
            'current_collections' => $current_collections,
            'current_goals' => $current_goals,
            'current_collections_completed' => $current_collections_completed,
            'current_goals_completed' => $current_goals_completed,
            'current_collections_in_progress' => $current_collections_in_progress,
            'current_goals_in_progress' => $current_goals_in_progress,
            'current_collections_expired' => $current_collections_expired,
            'current_collections_completed_percentage' => $current_collections > 0
                ? ($current_collections_completed / $current_collections) * 100
                : 0,
            'current_goals_completed_percentage' => $current_goals > 0
                ? ($current_goals_completed / $current_goals) * 100
                : 0,
        ];
    }

    public function calculateGeneralStatistics(): array
    {
        return [];
    }
}
