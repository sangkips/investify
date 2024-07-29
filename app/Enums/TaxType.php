<?php

namespace App\Enums;

enum TaxType: int
{

    case INCLUSIVE = 0;
    case EXCLUSIVE = 1;

    public function label(): string
    {
        return match ($this) {
            self::EXCLUSIVE => __('Exclusive'),
            self::INCLUSIVE => __('Inclusive'),
        };
    }
}
