<?php

namespace App\Services;

use App\Models\Collection;
use App\Enums\StatusMessage;

class CollectionService
{
    public static function getStatus(Collection $collection): ?array
    {
        if ($collection->isCyclic()) {
            return self::getCyclicStatus($collection);
        }

        return self::getNonCyclicStatus($collection);
    }

    public static function getCyclicStatus(Collection $collection): ?array
    {
        $completed = $collection->isCompleted();
        $expired = $collection->hasExpired();

        if ($expired) {
            $collection->resetCollection();
            return $completed
                ? self::createStatus(StatusMessage::SUCCESS_CYCLIC)
                : self::createStatus(StatusMessage::ERROR_CYCLIC);
        }

        return null;
    }

    public static function getNonCyclicStatus(Collection $collection): ?array
    {
        $completed = $collection->isCompleted();

        if ($collection->hasExpired() && !$completed) {
            return self::createStatus(StatusMessage::ERROR_NOT_CYCLIC);
        }

        if ($completed) {
            return self::createStatus(StatusMessage::SUCCESS_NOT_CYCLIC);
        }

        return null;
    }

    protected static function createStatus(StatusMessage $statusMessage): array
    {
        return [
            'title' => $statusMessage->title(),
            'message' => $statusMessage->message(),
            'status' => $statusMessage->status(),
        ];
    }
}
