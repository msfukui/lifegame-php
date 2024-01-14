<?php

declare(strict_types=1);

namespace LifeGamePhp;

final class LifeGame
{
    // ライフゲームのルール定義に関連する定数
    private const int BORN_NUMBER = 3; // 誕生
    private const array LIVES_NUMBER = [2, 3]; // 生存・過疎・過密

    private array $board = [];

    /**
     * @param string[][] $board
     * @return self
     */
    public static function create(array $board): self
    {
        $lifeGame = new self();
        $lifeGame->board = $board;
        return $lifeGame;
    }

    public function run(int $generation): void
    {
        $this->init($generation);
    }

    private function init(int $generation): void
    {
        $this->printBoard();

        // $generation 分世代進めて出力
        for ($times = 0; $times < $generation; $times++) {
            $bb = [];
            for ($i = 0; $i < count($this->board); $i++) {
                for ($j = 0; $j < count($this->board[$i]); $j++) {

                    if ($this->board[$i][$j] === '□') {
                        // 誕生の場合
                        $count = 0;
                        if ($i > 0 && $j > 0 && $this->board[$i - 1][$j - 1] === ("■")) {
                            $count += 1;
                        }
                        if ($i > 0 && $this->board[$i - 1][$j] === "■") {
                            $count += 1;
                        }
                        if ($i > 0 && $j < 4 && $this->board[$i - 1][$j + 1] === ("■")) {
                            $count += 1;
                        }
                        if ($j > 0 && $this->board[$i][$j - 1] === ("■")) {
                            $count += 1;
                        }
                        if ($j < count($this->board[$i]) - 1 && $this->board[$i][$j + 1] === ("■")) {
                            $count += 1;
                        }
                        if ($i < count($this->board) - 1 && $j > 0 && $this->board[$i + 1][$j - 1] === ("■")) {
                            $count += 1;
                        }
                        if ($i < count($this->board) - 1 && $this->board[$i + 1][$j] === ("■")) {
                            $count += 1;
                        }
                        if ($i < count($this->board) - 1 && $j < count($this->board[$i]) - 1 && $this->board[$i + 1][$j + 1] === ("■")) {
                            $count += 1;
                        }

                        if ($count === self::BORN_NUMBER) {
                            $bb[$i][$j] = "■";
                        } else {
                            $bb[$i][$j] = "□";
                        }
                    }
                    if ($this->board[$i][$j] === ("■")) {
                        // 生存・過疎・過密の場合
                        $count = 0;

                        if ($i > 0 && $this->board[$i - 1][$j] === ("■")) {
                            $count += 1;
                        }
                        if ($j > 0 && $this->board[$i][$j - 1] === ("■")) {
                            $count += 1;
                        }
                        if ($j < count($this->board[$i]) - 1 && $this->board[$i][$j + 1] === ("■")) {
                            $count += 1;
                        }
                        if ($i < count($this->board) - 1 && $this->board[$i + 1][$j] === ("■")) {
                            $count += 1;
                        }

                        if (in_array($count, self::LIVES_NUMBER, true)) {
                            $bb[$i][$j] = "■";
                        } else {
                            $bb[$i][$j] = "□";
                        }
                    }
                }
            }
            $this->board = $bb;

            // 出力
            $this->printGen($times);
            $this->printBoard();
        }
    }

    private function printBoard(): void
    {
        for ($i = 0; $i < count($this->board); $i++) {
            $line = "";
            for ($j = 0; $j < count($this->board[$i]); $j++) {
                $line = $line . $this->board[$i][$j];
            }
            echo($line . PHP_EOL);
        }
    }

    private function printGen(int $times): void
    {
        echo($times . "==========" . PHP_EOL);
    }
}
