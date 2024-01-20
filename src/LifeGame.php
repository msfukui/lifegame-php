<?php

declare(strict_types=1);

namespace LifeGamePhp;

use Exception;

final class LifeGame
{
    // ライフゲームのルール定義に関する定数
    private const int BORN_NUMBER = 3; // 誕生
    private const array LIVES_NUMBER = [2, 3]; // 生存・過疎・過密

    private function __construct(
        private Board $board
    ) {
    }

    /**
     * ライフゲームの初期値を生成する
     *
     * @param string[][] $board
     * @return self
     * @throws Exception
     *   ボードの横列が一定でない場合
     *   ボードのマークが異なる場合
     */
    public static function create(array $board): self
    {
        return new self(Board::create($board));
    }

    /**
     * ライフゲームを指定された世代分実行する
     *
     * @param int $numberOfGenerations
     * @return void
     * @throws Exception
     */
    public function run(int $numberOfGenerations): void
    {
        // 初期値を出力する
        $this->printBoard();

        // 指定された世代数の数だけ世代を進めて都度結果を出力する
        for ($times = 0; $times < $numberOfGenerations; $times++) {
            $this->next();
            $this->printBoardWithGen($times);
        }
    }

    /**
     * ライフゲームの世代を一つ進める
     *
     * @throws Exception
     */
    private function next(): void
    {
        $nextBoard = [];
        for ($i = 0; $i < $this->board->maxY(); $i++) {
            for ($j = 0; $j < $this->board->maxX(); $j++) {
                // 周囲の生きているセルの数を数えて生死を判定する
                $nextBoard[$i][$j] = $this->getStatusOnRules(
                    $this->board->outputCell($i, $j),
                    $this->board->surroundingLivingNumbers($i, $j)
                );
            }
        }
        $this->board = Board::create($nextBoard);
    }


    /*
     * TODO: ルールに関する実処理は一部を Board クラスに移譲したい
     */
    /**
     * 指定されたセルについてライフゲームのルールに従って生死を判定して結果を返す
     *
     * @param string $cell
     * @param int $surroundLivingNumbers
     * @return string
     */
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

    /**
     * 現在のボードの内容を標準出力する
     *
     * @return void
     */
    private function printBoard(): void
    {
        $this->board->print();
    }

    /**
     * 指定された世代数とボードの内容を標準出力する
     *
     * @param int $numberOfGenerations
     * @return void
     */
    private function printBoardWithGen(int $numberOfGenerations): void
    {
        echo($numberOfGenerations . '==========' . PHP_EOL);
        $this->printBoard();
    }
}
