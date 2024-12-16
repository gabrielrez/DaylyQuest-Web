<?php

namespace App\Models;

use App\Enums\StatusMessage;
use App\Enums\Cyclic;
use App\Services\CollectionCyclicService;
use App\Services\CollectionNonCyclicService;
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

    public function isCompleted(): bool
    {
        return $this->goals->isNotEmpty() && $this->goals->every(fn($goal) => $goal->status === "completed");
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
        $this->goals->each(fn($goal) => $goal->update(['status' => "inProgress"]));

        $this->update([
            'deadline' => Carbon::tomorrow()->startOfDay(),
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
}
