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

    public function isCyclic()
    {
        return $this->cyclic == 1;
    }

    public function isCompleted()
    {
        return $this->goals->isNotEmpty() && $this->goals->every(fn($goal) => $goal->status === 1);
    }

    public function resetCollection()
    {
        $this->goals->each(fn($goal) => $goal->update(['status' => 0]));

        $this->update([
            'deadline' => Carbon::tomorrow()->startOfDay(),
        ]);
    }

    public function getStatus(): ?array
    {
        $completed = $this->isCompleted();
        $cyclic = $this->isCyclic();

        if ($cyclic) {
            if (!$completed && $this->hasExpired()) {
                $this->resetCollection();
                return [
                    'title' => "Don't give up! 🔁",
                    'message' => "The deadline for this collection has expired. You didn't complete this collection in time. However, this is a cyclic collection, you can aways try again!",
                    'status' => 'error',
                ];
            }

            if ($completed && $this->hasExpired()) {
                $title = 'Congrats! 🎉';
                $message = "You've completed this collection in time! New day, new goals!";

                $this->resetCollection();
                return [
                    'title' => $title,
                    'message' => $message,
                    'status' => 'success',
                ];
            }
        }

        if (!$completed && $this->hasExpired()) {
            return [
                'title' => 'Oops! ⌛',
                'message' => "The deadline for this collection has expired. You didn't complete this collection in time! Time to create a new collection and try again!",
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

    public function formattedDeadline(): string
    {
        $deadline = $this->deadline;

        return str_replace('-', '/', $deadline);
    }
}
