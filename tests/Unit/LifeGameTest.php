<?php

namespace LifeGamePhp;

describe('LifeGame#init', function () {
    it('ライフゲーム(ブリンカー)の初期値と3世代分の結果を出力する', function () {
        ob_start();
        $lifeGame = new LifeGame();
        $lifeGame->init();
        $output = ob_get_clean();
        expect($output)->toBe(file_get_contents(__DIR__ . '/../success.txt'));
    });
});
