<?php

namespace App\Support;

class Money
{
    public static function format(int $amount): string
    {
        return 'Ks '.number_format($amount);
    }
}
