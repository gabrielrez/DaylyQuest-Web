<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Collection extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'deadline',
        'cyclic',
        'status',
        'points',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function goals()
    {
        return $this->hasMany(Goal::class);
    }

    public function hasExpired(): bool
    {
        return Carbon::now()->greaterThan($this->deadline) && $this->cyclic != 1;
    }

    public function getStatus(): array|null
    {
        // Not Cyclic
        if ($this->cyclic != 1) {
            if (Carbon::now()->greaterThan($this->deadline)) {
                return [
                    'title' => 'Oops! ⌛',
                    'message' => "The deadline for this collection has expired. You didn't complete this collection in time!",
                    'status' => 'error',
                ];
            }

            if ($this->goals->every(fn($goal) => $goal->status === 1)) {
                return [
                    'title' => 'Congrats! 🎉',
                    'message' => "You've completed this collection!",
                    'status' => 'success',
                ];
            }
        }

        return null;
    }

    public function formatedDeadline(): string
    {
        $now = Carbon::now();
        $deadline = $this->deadline;
        $parsed_deadline = Carbon::parse($this->deadline);

        if ($now->diffInHours($parsed_deadline, false) < 24) {
            return 'tomorow';
        }

        return str_replace('/', '-', $deadline);
    }
}
