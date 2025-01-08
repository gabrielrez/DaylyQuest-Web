<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TimezoneService
{
    public static function setTimezone($timezone): void
    {
        if (!in_array($timezone, \DateTimeZone::listIdentifiers())) {
            throw new \InvalidArgumentException("Timezone inválido: {$timezone}");
        }

        config(['app.timezone' => $timezone]);
        date_default_timezone_set($timezone);
    }
}
