<?php

namespace App\Services;

use App\Models\Collection;
use App\Enums\StatusMessage;

class CollectionNonCyclicService extends CollectionService
{
    public function getStatus(Collection $collection): ?array
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
}
