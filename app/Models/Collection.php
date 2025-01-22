<?php

namespace App\Models;

use App\Enums\StatusMessage;
use App\Enums\Cyclic;
use App\Services\CollectionCyclicService;
use App\Services\CollectionNonCyclicService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

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
        $timezone = $this->user->timezone;

        $expired = Carbon::now($timezone)->greaterThan(
            Carbon::parse($this->deadline)->setTimezone($timezone)
        );

        if ($expired && !$this->isCompleted()) {
            $this->update(['status' => 'expired']);
        }

        return $expired;
    }

    public function isCompleted(): bool
    {
        $completed = $this->goals->isNotEmpty() && $this->goals->every(fn($goal) => $goal->status === "completed");

        // Observer? 🤔
        $this->setStatus($completed);

        return $completed;
    }

    protected function setStatus($completed): void
    {
        $completed
            ? $this->updateCompletedStatus()
            : $this->updateNotCompletedStatus();
    }

    public function updateCompletedStatus(): void
    {
        $this->update(['status' => 'completed']);
    }

    public function updateNotCompletedStatus(): void
    {
        $this->update(['status' => 'inProgress']);
    }

    public function resetCollection(): void
    {
        $timezone = $this->user->timezone;

        $this->goals->each(fn($goal) => $goal->update(['status' => "inProgress"]));

        $this->update([
            'deadline' => Carbon::tomorrow($timezone)->startOfDay()->setTimezone($timezone),
        ]);
    }

    public function isCyclic(): bool
    {
        return $this->cyclic === 1;
    }

    public function completetionPercentage($goals): float
    {
        return $goals->count() > 0
            ? ($goals->where('status', 'completed')->count() / $goals->count()) * 100
            : 0;
    }

    public function filterCollections(string $filter)
    {
        $collections = $this->where('user_id', Auth::id());

        if ($filter === 'completed') {
            $collections->where('status', 'completed');
        }

        if ($filter === 'in-progress') {
            $collections->where('status', 'inProgress');
        }

        if ($filter === 'expired') {
            $collections->whereDate('deadline', '<', now());
        }

        return $collections->get();
    }
}
