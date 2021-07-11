<?php

namespace App\Helpers;

class Helper
{
    public static function formatPriceToDatabase($price)
    {
        return str_replace(['.',','], ['', '.'], $price);
    }
}
