<?php

namespace App\Models\Enums;

use Illuminate\Contracts\Support\DeferringDisplayableValue;

enum Gender: string implements DeferringDisplayableValue
{
    case MALE = 'M';
    case FEMALE = 'F';

    public function isMale(): bool
    {
        return $this == self::MALE;
    }

    public function isFemale(): bool
    {
        return $this == self::FEMALE;
    }

    public function resolveDisplayableValue(): string
    {
        return match (true) {
            $this->isMale()   => 'Male',
            $this->isFemale() => 'Female'
        };
    }
}
