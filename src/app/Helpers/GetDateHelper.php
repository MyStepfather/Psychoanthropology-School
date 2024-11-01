<?php

namespace App\Helpers;

final class GetDateHelper
{
    public static function getCurrentDay(): int
    {
        return date('d');
    }

    public static function getCurrentWeekDay(): int
    {
        return date('w');
    }

    public static function getCurrentMonth(): int
    {
        return date('n');
    }

    public static function getCurrentYear(): int
    {
        return date('Y');
    }
}
