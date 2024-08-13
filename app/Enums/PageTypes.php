<?php

namespace App\Enums;

enum PageTypes: int
{
    case slider = 1;
    case ourStory = 2;


    public static function sliderValue(): int
    {
        return self::slider->value;
    }
    public static function ourStoryValue(): int
    {
        return self::ourStory->value;
    }
}
