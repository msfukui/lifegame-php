<?php

declare(strict_types=1);

namespace LifeGamePhp;

use Exception;

describe('Board#create', function () {

    it('ライフゲーム(ブリンカー)の初期ボードを生成する', function () {
        $board = Board::create(
            board: [
                ['□', '□', '□', '□', '□'],
                ['□', '□', '□', '□', '□'],
                ['□', '■', '■', '■', '□'],
                ['□', '□', '□', '□', '□'],
                ['□', '□', '□', '□', '□'],
            ]
        );
        expect($board)->toBeInstanceOf(Board::class);
    });

    it('ボードの横列が一定でない場合は例外を投げる', function () {
        Board::create(
            board: [
                ['□', '□', '□', '□', '□'],
                ['□', '□', '□', '□', '□'],
                ['□', '■', '■', '■',],
                ['□', '□', '□', '□', '□'],
                ['□', '□', '□', '□', '□'],
            ]
        );
    })->throws(Exception::class);

    it('ボードのマークと定義したマークに違いがあれば例外を投げる', function () {
        Board::create(
            board: [
                ['□', '□', '□', '□', '□'],
                ['□', '□', '□', '□', '□'],
                ['□', '◆', '◆', '◆', '□'],
                ['□', '□', '□', '□', '□'],
                ['□', '□', '□', '□', '□'],
            ]
        );
    })->throws(Exception::class);
});

describe('Board#maxY', function () {

    it('ボードの縦列の数を返却する', function () {
        $board = Board::create(
            [
                ['□', '□', '□', '□', '□'],
                ['□', '□', '□', '□', '□'],
                ['□', '■', '■', '■', '□'],
            ]
        );
        expect($board->maxY())->toBe(3);
    });
});

describe('Board#maxX', function () {

    it('ボードの横列の数を返却する', function () {
        $board = Board::create(
            [
                ['□', '□', '□', '□', '□'],
                ['□', '□', '□', '□', '□'],
                ['□', '■', '■', '■', '□'],
            ]
        );
        expect($board->maxX())->toBe(5);
    });
});

describe('Board#print', function () {

    it('ライフゲーム(ブリンカー)の初期値を標準出力する', function () {
        ob_start();
        Board::create(
            [
                ['□', '□', '□', '□', '□'],
                ['□', '□', '□', '□', '□'],
                ['□', '■', '■', '■', '□'],
                ['□', '□', '□', '□', '□'],
                ['□', '□', '□', '□', '□'],
            ]
        )->print();
        $output = ob_get_clean();
        expect($output)->toBe(
            '□□□□□' . PHP_EOL .
            '□□□□□' . PHP_EOL .
            '□■■■□' . PHP_EOL .
            '□□□□□' . PHP_EOL .
            '□□□□□' . PHP_EOL
        );
    });
});

describe('Board#surroundingLivingNumbers', function () {

    it('指定したセルの周囲の生きているセルの数を返却する', function () {
        $board = Board::create(
            [
                ['□', '■', '□', '□', '□'],
                ['□', '■', '□', '□', '□'],
                ['□', '■', '□', '□', '□'],
            ]
        );
        expect($board->surroundingLivingNumbers(1, 1))->toBe(2);
    });
});

describe('Board#outputCell', function () {

    it('指定したボード位置のセルの値を返却する', function () {
        expect(Board::create(
            [
                ['□', '□', '□', '□', '□'],
                ['□', '□', '□', '□', '□'],
                ['□', '■', '■', '■', '□'],
                ['□', '□', '□', '□', '□'],
                ['□', '□', '□', '□', '□'],
            ]
        )->outputCell(2, 2))->toBe('■');
    });
});

describe('Board#printClean', function () {

    it('ライフゲーム(ブリンカー)の初期値を標準出力する', function () {
        ob_start();
        Board::create(
            [
                ['□', '□', '□', '□', '□'],
                ['□', '□', '□', '□', '□'],
                ['□', '■', '■', '■', '□'],
                ['□', '□', '□', '□', '□'],
                ['□', '□', '□', '□', '□'],
            ]
        )->printClean(0);
        $output = ob_get_clean();
        expect($output)->toBe(
            "\033[2J\033[0;0H\033[0;0H" .
            '□□□□□' . PHP_EOL .
            '□□□□□' . PHP_EOL .
            '□■■■□' . PHP_EOL .
            '□□□□□' . PHP_EOL .
            '□□□□□' . PHP_EOL
        );
    });
});
