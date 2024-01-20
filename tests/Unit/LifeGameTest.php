<?php

namespace LifeGamePhp;

describe('LifeGame#run', function () {
    it('ライフゲーム(ブリンカー)の初期値と3世代分の結果を出力する', function () {
        ob_start();
        LifeGame::create(
            [
                ['□', '□', '□', '□', '□'],
                ['□', '□', '□', '□', '□'],
                ['□', '■', '■', '■', '□'],
                ['□', '□', '□', '□', '□'],
                ['□', '□', '□', '□', '□'],
            ]
        )->run(3);
        $output = ob_get_clean();
        expect($output)->toBe(file_get_contents(__DIR__ . '/../success.txt'));
    });
});
