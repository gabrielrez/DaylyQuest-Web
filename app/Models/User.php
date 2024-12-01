<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

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

    public function calculateStatistics(): array
    {
        $collections_total = $this->Collections->count();

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
            $goals_completed
        ];
    }
}
