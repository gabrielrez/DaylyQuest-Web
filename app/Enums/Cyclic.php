<?php

namespace App\Enums;

enum Cyclic: int
{
    case CYCLIC = 1;
    case NON_CYCLIC = 0;

    public function isCyclic(): bool
    {
        return $this === self::CYCLIC;
    }
}
