<?php

declare(strict_types=1);

namespace LifeGamePhp;

describe('Cell', function () {

    it('Cell::create', function () {
        expect(Cell::create(true))->toBeInstanceOf(Cell::class);
    });

    describe('Cell#isAlive', function () {

        it('生きているセルを生成できる', function () {
            expect(Cell::create(true)->isAlive())->toBeTrue();
        });
        it('生きていないセルを生成できる', function () {
            expect(Cell::create(false)->isAlive())->toBeFalse();
        });
    });

    describe('Cell#isDead', function () {

        it('死んでいるセルを生成できる', function () {
            expect(Cell::create(true)->isDead())->toBeFalse();
        });
        it('死んでいないセルを生成できる', function () {
            expect(Cell::create(false)->isDead())->toBeTrue();
        });
    });
});
