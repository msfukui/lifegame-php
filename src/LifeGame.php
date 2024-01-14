<?php

declare(strict_types=1);

namespace LifeGamePhp;

final class LifeGame
{
    // ライフゲームのルール定義に関する定数
    private const int BORN_NUMBER = 3; // 誕生
    private const array LIVES_NUMBER = [2, 3]; // 生存・過疎・過密

    private function __construct(
        private array $board = []
    ) {
    }

    /**
     * @param string[][] $board
     * @return self
     */
    public static function create(array $board): self
    {
        // TODO: ここで渡された $board が正しい形式かどうかをチェックする
        return new self($board);
    }

    public function run(int $genNumber): void
    {
        // 初期値を出力する
        $this->printBoard();

        // 指定された世代数の数だけ世代を進めて都度結果を出力する
        for ($times = 0; $times < $genNumber; $times++) {
            $this->next();
            $this->printBoardWithGen($times);
        }
    }

    private function printBoard(): void
    {
        $x = count($this->board);
        for ($i = 0; $i < $x; $i++) {
            $y = count($this->board[$i]);
            $line = '';
            for ($j = 0; $j < $y; $j++) {
                $line = $line . $this->board[$i][$j];
            }
            echo($line . PHP_EOL);
        }
    }

    private function printBoardWithGen(int $times): void
    {
        echo($times . '==========' . PHP_EOL);
        $this->printBoard();
    }

    private function next(): void
    {
        $nextBoard = [];
        $x = count($this->board);
        for ($i = 0; $i < $x; $i++) {
            $y = count($this->board[$i]);
            for ($j = 0; $j < $y; $j++) {
                // 周囲の生きているセルの数を数えて生死を判定する
                $nextBoard[$i][$j] = $this->getStatusOnRules(
                    $this->board[$i][$j],
                    $this->surroundingLivingNumbers($i, $j)
                );
            }
        }
        $this->board = $nextBoard;
    }

    // ライフゲームのルールに従ってセルの生死を判定して返す
    private function getStatusOnRules(string $cell, int $surroundLivingNumbers): string
    {
        if ($cell === '□') {
            // 誕生の判定
            if ($surroundLivingNumbers === self::BORN_NUMBER) {
                return '■';
            } else {
                return '□';
            }
        } else {
            // 生存・過疎・過密の判定
            if (in_array($surroundLivingNumbers, self::LIVES_NUMBER, true)) {
                return '■';
            } else {
                return '□';
            }
        }
    }

    // 周囲の生きているセルの数を数えて返す
    private function surroundingLivingNumbers(int $x, int $y): int
    {
        $maxX = count($this->board);
        $maxY = count($this->board[$x]);

        $count = 0;

        for ($i = $x - 1; $i <= $x + 1; $i++) {
            for ($j = $y - 1; $j <= $y + 1; $j++) {
                // 自分自身はカウントしない
                if ($i === $x && $j === $y) {
                    continue;
                }
                // 範囲外はカウントしない
                if ($i < 0 || $i >= $maxX || $j < 0 || $j >= $maxY) {
                    continue;
                }
                // 生きているセルをカウントする
                if ($this->board[$i][$j] === ('■')) {
                    $count += 1;
                }
            }
        }

        return $count;
    }
}
