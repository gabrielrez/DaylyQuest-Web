<?php

namespace App\Services;

use App\Models\Collection;
use App\Enums\StatusMessage;

class CollectionCyclicService extends CollectionService
{
    public function getStatus(Collection $collection): ?array
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
}
