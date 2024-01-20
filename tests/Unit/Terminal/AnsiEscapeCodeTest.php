<?php

declare(strict_types=1);

namespace LifeGamePhp\Terminal;

describe('AnsiEscapeCode', function () {

    it('AnsiEscapeCode::clear', function () {
        ob_start();
        AnsiEscapeCode::clear();
        $output = ob_get_clean();
        $this->expect($output)->toBe("\033[2J\033[0;0H");
    });

    it('AnsiEscapeCode::moveCursorToUpperLeft', function () {
        ob_start();
        AnsiEscapeCode::moveCursorToUpperLeft();
        $output = ob_get_clean();
        $this->expect($output)->toBe("\033[0;0H");
    });
});
