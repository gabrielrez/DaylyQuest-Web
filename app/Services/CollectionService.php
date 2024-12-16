<?php

namespace App\Services;

use App\Models\Collection;
use App\Enums\StatusMessage;

class CollectionService
{
    public function getStatus(Collection $collection): ?array
    {
        if ($collection->isCyclic()) {
            return $this->getCyclicStatus($collection);
        }

        return $this->getNonCyclicStatus($collection);
    }

    public function getCyclicStatus(Collection $collection): ?array
    {
        $completed = $collection->isCompleted();
        $expired = $collection->hasExpired();

        if ($expired) {
            $collection->resetCollection();
            return $completed
                ? $this->createStatus(StatusMessage::SUCCESS_CYCLIC)
                : $this->createStatus(StatusMessage::ERROR_CYCLIC);
        }

        return null;
    }

    public function getNonCyclicStatus(Collection $collection): ?array
    {
        $completed = $collection->isCompleted();

        if ($collection->hasExpired() && !$completed) {
            return $this->createStatus(StatusMessage::ERROR_NOT_CYCLIC);
        }

        if ($completed) {
            return $this->createStatus(StatusMessage::SUCCESS_NOT_CYCLIC);
        }

        return null;
    }

    protected function createStatus(StatusMessage $statusMessage): array
    {
        return [
            'title' => $statusMessage->title(),
            'message' => $statusMessage->message(),
            'status' => $statusMessage->status(),
        ];
    }
}
