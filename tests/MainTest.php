<?php

declare(strict_types=1);

namespace LifeGamePhp;

it('Main', function () {
    ob_start();
    require_once __DIR__ . '/../src/Main.php';
    $output = ob_get_clean();
    expect($output)->toBe(file_get_contents(__DIR__ . '/success.txt'));
});
