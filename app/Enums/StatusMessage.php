<?php

namespace App\Enums;

enum StatusMessage: string
{
    case ERROR_CYCLIC = 'error_cyclic';
    case SUCCESS_CYCLIC = 'success_cyclic';
    case ERROR_NOT_CYCLIC = 'error_not_cyclic';
    case SUCCESS_NOT_CYCLIC = 'success_not_cyclic';

    public function title(): string
    {
        return match ($this) {
            self::ERROR_CYCLIC => "Oops! ⌛",
            self::SUCCESS_CYCLIC => 'Congrats! 🎉',
            self::ERROR_NOT_CYCLIC => 'Oops! ⌛',
            self::SUCCESS_NOT_CYCLIC => 'Congrats! 🎉',
        };
    }

    public function message(): string
    {
        return match ($this) {
            self::ERROR_CYCLIC => "The deadline for this collection has expired. However, this is a cyclic collection. Don't give up, you can always try again! 🔁",
            self::SUCCESS_CYCLIC => "You've completed this collection in time! New day, new goals!",
            self::ERROR_NOT_CYCLIC => "The deadline for this collection has expired. You didn't complete this collection in time! Time to create a new collection and try again!",
            self::SUCCESS_NOT_CYCLIC => "You've completed this collection in time!",
        };
    }

    public function status(): string
    {
        return match ($this) {
            self::ERROR_CYCLIC, self::ERROR_NOT_CYCLIC => 'error',
            self::SUCCESS_CYCLIC, self::SUCCESS_NOT_CYCLIC => 'success',
        };
    }
}
