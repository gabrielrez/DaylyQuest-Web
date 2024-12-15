<?php

namespace App\Services;

use App\Models\Collection;
use App\Enums\StatusMessage;

class CollectionService
{
    protected function createStatus(StatusMessage $statusMessage): array
    {
        return [
            'title' => $statusMessage->title(),
            'message' => $statusMessage->message(),
            'status' => $statusMessage->status(),
        ];
    }
}
