<?php

declare(strict_types=1);

namespace LifeGamePhp\Terminal;

use Mockery;

describe('AnsiEscapeCode', function () {

    beforeEach(function () {
        $this->t = new AnsiEscapeCode();
    });

    it('AnsiEscapeCode#clear', function () {
        ob_start();
        $this->t->clear();
        $output = ob_get_clean();
        $this->expect($output)->toBe("\033[2J\033[0;0H");
    });

    it('AnsiEscapeCode#moveCursorToUpperLeft', function () {
        ob_start();
        $this->t->moveCursorToUpperLeft();
        $output = ob_get_clean();
        $this->expect($output)->toBe("\033[0;0H");
    });

    it('AnsiEscapeCode#moveCursor', function () {
        ob_start();
        $this->t->moveCursor(2, 2);
        $output = ob_get_clean();
        $this->expect($output)->toBe("\033[2;2H");
    });

    it('AnsiEscapeCode#getCursorPosition', function () {
        $in = Mockery::mock(AnsiEscapeCode::class)
            ->makePartial();
        $in->shouldAllowMockingProtectedMethods();
        $in->shouldReceive('fread')
            ->andReturn("\033[1;2R");

        ob_start();
        $actual = $in->getCursorPosition();
        ob_get_clean();

        $this->expect($actual)->toBe(['width' => 2, 'height' => 1]);
    });
});
