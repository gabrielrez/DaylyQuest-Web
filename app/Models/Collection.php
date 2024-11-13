<?php

namespace App\Models;

use App\Enums\StatusMessage;
use App\Enums\Cyclic;
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

    protected $casts = [
        'cyclic' => Cyclic::class,
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
        $cyclic = $this->cyclic->isCyclic();
        $expired = $this->hasExpired();

        if ($cyclic) {
            return $this->getCyclicStatus($completed, $expired);
        }

        return $this->getNonCyclicStatus($completed, $expired);
    }

    private function getCyclicStatus(bool $completed, bool $expired): ?array
    {
        if ($expired) {
            $this->resetCollection();
            return $completed
                ? $this->createStatus(StatusMessage::SUCCESS_CYCLIC)
                : $this->createStatus(StatusMessage::ERROR_CYCLIC);
        }

        return null;
    }

    private function getNonCyclicStatus(bool $completed, bool $expired): ?array
    {
        if ($expired && !$completed) {
            return $this->createStatus(StatusMessage::ERROR_NOT_CYCLIC);
        }

        if ($completed) {
            return $this->createStatus(StatusMessage::SUCCESS_NOT_CYCLIC);
        }

        return null;
    }

    private function createStatus(StatusMessage $statusMessage): array
    {
        return [
            'title' => $statusMessage->title(),
            'message' => $statusMessage->message(),
            'status' => $statusMessage->status(),
        ];
    }

    public function formattedDeadline(): string
    {
        $deadline = $this->deadline;

        return str_replace('-', '/', $deadline);
    }
}
