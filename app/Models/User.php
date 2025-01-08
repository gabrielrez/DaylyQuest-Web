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

    public function calculateStatistics(): array
    {
        $collections_total = $this->collections->count();

        $goals_total = $this->collections->flatMap(function ($collection) {
            return $collection->goals;
        })->count();

        $collections_completed = $this->collections->filter(function ($collection) {
            return $collection->goals->isNotEmpty() &&
                $collection->goals->every(function ($goal) {
                    return $goal->status === 'completed';
                });
        })->count();

        $goals_completed = $this->collections->flatMap(function ($collection) {
            return $collection->goals->where('status', 'completed');
        })->count();

        return [
            $collections_total,
            $goals_total,
            $collections_completed,
            $goals_completed,
        ];

        // Add to the database if the statistic number is greater than the previous/current one 
        // as it means it is a new statistic 🤯
    }
}
