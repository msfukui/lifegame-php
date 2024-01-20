<?php

declare(strict_types=1);

namespace LifeGamePhp\Terminal;

class AnsiEscapeCode
{
    public static function clear(): void
    {
        echo "\033[2J\033[0;0H";
    }

    public static function moveCursorToUpperLeft(): void
    {
        echo "\033[0;0H";
    }
}
