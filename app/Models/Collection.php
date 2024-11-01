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
        return Carbon::now()->greaterThan($this->deadline);
    }

    public function isCompleted()
    {
        return $this->goals->isNotEmpty() && $this->goals->every(fn($goal) => $goal->status === 1);
    }

    public function getStatus(): ?array
    {
        $completed = $this->isCompleted();

        if (!$completed && $this->hasExpired()) {
            return [
                'title' => 'Oops! ⌛',
                'message' => "The deadline for this collection has expired. You didn't complete this collection in time!",
                'status' => 'error',
            ];
        }

        if ($completed) {
            $title = $this->hasExpired() ? 'Better late than never!' : 'Congrats! 🎉';
            $message = $this->hasExpired()
                ? "You've completed this collection!"
                : "You've completed this collection in time!";

            return [
                'title' => $title,
                'message' => $message,
                'status' => 'success',
            ];
        }

        return null;
    }

    public function resetGoals()
    {
        foreach ($this->goals as $goal) {
            $goal->status = 0;
            $goal->save();
        }
    }

    public function resetDeadline()
    {
        $this->deadline = Carbon::tomorrow()->startOfDay();
        $this->save();
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
