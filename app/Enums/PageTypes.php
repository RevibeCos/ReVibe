<?php

namespace App\Enums;

enum PageTypes: int
{
    case slider = 1;

    public static function sliderValue(): int
    {
        return self::slider->value;
    }
}
