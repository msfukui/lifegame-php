<?php

declare(strict_types=1);

namespace LifeGamePhp;

use Exception;
use LifeGamePhp\Terminal\AnsiEscapeCode;

readonly class Board
{
    private int $maxX;
    private int $maxY;

    private function __construct(
        private array $board,
        private array $cells,
        private array $marks,
        private AnsiEscapeCode $terminal
    ) {
        $this->maxX = count($board[0]);
        $this->maxY = count($board);
    }

    /**
     * ボードを生成する
     *
     * @param string[][] $board
     *   ボードのマークを表す文字列の二次元配列
     * @param array $marks
     *   マークとセルの生死の真偽値を対応させた連想配列
     * @return self
     * @throws Exception
     *   ボードの横列が一定でない場合
     *   ボードのマークと定義したマークに違いがある場合
     */
    public static function create(
        array $board,
        array $marks = ['■' => true, '□' => false]
    ): self {
        $cells = [];
        $maxX = count($board[0]);
        $maxY = count($board);

        for ($i = 0; $i < $maxY; $i++) {
            if (count($board[$i]) !== $maxX) {
                throw new Exception('The number of columns is different.');
            }
            for ($j = 0; $j < $maxX; $j++) {
                if (!array_key_exists($board[$i][$j], $marks)) {
                    throw new Exception('The mark is not defined.');
                }
                $cells[$i][$j] = Cell::create($marks[$board[$i][$j]]);
            }
        }
        return new self($board, $cells, $marks, new AnsiEscapeCode());
    }

    /**
     * ボード全体を返却する
     *
     * @return array
     */
    public function output(): array
    {
        return $this->board;
    }

    /**
     * 指定したボード位置のセルの値を返却する
     *
     * @param int $x
     * @param int $y
     * @return string
     */
    public function outputCell(int $x, int $y): string
    {
        return $this->board[$x][$y];
    }

    /**
     * ボードの横列の数を返却する
     *
     * @return int
     */
    public function maxX(): int
    {
        return $this->maxX;
    }

    /**
     * ボードの縦列の数を返却する
     *
     * @return int
     */
    public function maxY(): int
    {
        return $this->maxY;
    }

    /**
     * ボードを標準出力する
     *
     * @return void
     */
    public function print(): void
    {
        for ($i = 0; $i < $this->maxY; $i++) {
            $line = '';
            for ($j = 0; $j < $this->maxX; $j++) {
                $mark = array_search(
                    needle: $this->cells[$i][$j]->isAlive(),
                    haystack: $this->marks,
                    strict: true
                );
                $line = $line . $mark;
            }
            echo($line . PHP_EOL);
        }
    }


    /**
     * 表示内容をクリアした上でボードの内容を標準出力する
     * 次の表示への切り替えを考慮して, 指定した一定秒待機する
     *
     * @param int $waitingSeconds
     * @return void
     */
    public function printClean(int $waitingSeconds = 1): void
    {
        $this->terminal->clear();
        $this->terminal->moveCursorToUpperLeft();
        $this->print();
        sleep($waitingSeconds);
    }

    /**
     * 指定したセルの周囲の生きているセルの数を数えて返す
     *
     * @param int $x
     * @param int $y
     * @return int
     */
    public function surroundingLivingNumbers(int $x, int $y): int
    {
        $count = 0;

        for ($i = $x - 1; $i <= $x + 1; $i++) {
            for ($j = $y - 1; $j <= $y + 1; $j++) {
                // 自分自身はカウントしない
                if ($i === $x && $j === $y) {
                    continue;
                }
                // 範囲外はカウントしない
                if ($i < 0 || $i >= $this->maxY ||
                    $j < 0 || $j >= $this->maxX) {
                    continue;
                }
                // 生きているセルをカウントする
                if ($this->cells[$i][$j]->isAlive()) {
                    $count += 1;
                }
            }
        }

        return $count;
    }
}
