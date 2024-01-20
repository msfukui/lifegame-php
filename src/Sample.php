<?php

declare(strict_types=1);

namespace LifeGamePhp;

require_once __DIR__ . '/../vendor/autoload.php';

while (1) {
    Board::create(
        [
            ['□', '□', '□', '□', '□'],
            ['□', '□', '□', '□', '□'],
            ['□', '■', '■', '■', '□'],
            ['□', '□', '□', '□', '□'],
            ['□', '□', '□', '□', '□'],
        ]
    )->printClean();
    Board::create(
        [
            ['□', '□', '□', '□', '□'],
            ['□', '□', '■', '□', '□'],
            ['□', '□', '■', '□', '□'],
            ['□', '□', '■', '□', '□'],
            ['□', '□', '□', '□', '□'],
        ]
    )->printClean();
}
