<?php

namespace App\Enums\Traits;

trait Arrayable
{
    public static function toArray(): array
    {
        return array_column(self::cases(), 'value');
    }
}
