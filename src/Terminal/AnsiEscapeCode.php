<?php

declare(strict_types=1);

namespace LifeGamePhp\Terminal;

class AnsiEscapeCode
{
    public function clear(): void
    {
        echo "\033[2J\033[0;0H";
    }

    public function moveCursorToUpperLeft(): void
    {
        echo "\033[0;0H";
    }

    /**
     * カーソルを指定した位置に移動する
     *
     * @param int $width
     * @param int $height
     * @return void
     */
    public function moveCursor(int $width, int $height): void
    {
        echo "\033[$height;{$width}H";
    }

    /**
     * カーソルの現在の位置を取得する
     *
     * @return array{width: int, height: int}
     */
    public function getCursorPosition(): array
    {
        echo "\033[6n";
        $response = $this->fread(STDIN, 32);
        preg_match('/\033\[(\d+);(\d+)R/', $response, $matches);
        return [
            'width' => (int) $matches[2],
            'height' => (int) $matches[1],
        ];
    }

    protected function fread($stream, int $length): string
    {
        return fread($stream, $length);
    }
}
