<?php

namespace App\Macros;

class StrReverse
{
    public function __invoke(string $value): string
    {
        return strrev('your reversed string is: ' . $value);
    }
}
