<?php

declare(strict_types=1);

namespace LifeGamePhp;

readonly class Cell
{
    /**
     * @param bool $cell
     *   true: 生きているセル, false: 死んでいるセル
     */
    private function __construct(
        private bool $cell
    ) {
    }

    public static function create(bool $cell): Cell
    {
        return new self($cell);
    }

    public function isAlive(): bool
    {
        return $this->cell === true;
    }

    public function isDead(): bool
    {
        return !($this->isAlive());
    }
}
