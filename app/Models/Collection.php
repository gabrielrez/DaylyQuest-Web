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
        // Transformar em ENUM
        $status_messages = [
            'error_cyclic' => [
                'title' => "Don't give up! 🔁",
                'message' => "The deadline for this collection has expired. You didn't complete this collection in time. However, this is a cyclic collection, you can aways try again!",
                'status' => 'error',
            ],
            'success_cyclic' => [
                'title' => 'Congrats! 🎉',
                'message' => "You've completed this collection in time! New day, new goals!",
                'status' => 'success',
            ],
            'error_not_cyclic' => [
                'title' => 'Oops! ⌛',
                'message' => "The deadline for this collection has expired. You didn't complete this collection in time! Time to create a new collection and try again!",
                'status' => 'error',
            ],
            'success_not_cyclic' => [
                'title' => 'Congrats! 🎉',
                'message' => "You've completed this collection in time!",
                'status' => 'success',
            ],
        ];

        $completed = $this->isCompleted();
        $cyclic = $this->isCyclic();

        if ($cyclic) {
            if (!$completed && $this->hasExpired()) {
                $this->resetCollection();
                return $status_messages['error_cyclic'];
            }

            if ($completed && $this->hasExpired()) {
                $this->resetCollection();
                return $status_messages['success_cyclic'];
            }
        }

        if (!$completed && $this->hasExpired()) {
            return $status_messages['error_not_cyclic'];
        }

        if ($completed) {
            return $status_messages['success_not_cyclic'];
        }

        return null;
    }

    public function formattedDeadline(): string
    {
        $deadline = $this->deadline;

        return str_replace('-', '/', $deadline);
    }
}
