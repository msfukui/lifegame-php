<?php

declare(strict_types=1);

namespace LifeGamePhp;

require_once __DIR__ . '/../vendor/autoload.php';

LifeGame::create(
    [
        ['□', '□', '□', '□', '□'],
        ['□', '□', '□', '□', '□'],
        ['□', '■', '■', '■', '□'],
        ['□', '□', '□', '□', '□'],
        ['□', '□', '□', '□', '□'],
    ]
)->run(3);
