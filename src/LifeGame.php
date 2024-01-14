<?php

declare(strict_types=1);

namespace LifeGamePhp;

final class LifeGame
{
    public function init(): void
    {
        // 枠の初期化
        $b = [];
        for ($i = 0;
            $i < 5;
            $i++) {
            for ($j = 0;
                $j < 5;
                $j++) {
                $b[$i][$j] = "□";
            }
        }

        // ブリンカーの初期値を設定
        $b[2][1] = "■";
        $b[2][2] = "■";
        $b[2][3] = "■";

        // 初期状態を出力
        for ($i = 0; $i < 5; $i++) {
            $line = "";
            for ($j = 0; $j < 5; $j++) {
                $line = $line . $b[$i][$j];
            }
            echo($line . PHP_EOL);
        }

        // 3世代進めて出力
        for ($times = 0; $times < 3; $times++) {
            $bb = [];
            for ($i = 0; $i < 5; $i++) {
                for ($j = 0; $j < 5; $j++) {

                    if ($b[$i][$j] === '□') {
                        // 誕生の場合
                        $count = 0;
                        if ($i > 0 && $j > 0 && $b[$i - 1][$j - 1] === ("■")) {
                            $count += 1;
                        }
                        if ($i > 0 && $b[$i - 1][$j] === "■") {
                            $count += 1;
                        }
                        if ($i > 0 && $j < 4 && $b[$i - 1][$j + 1] === ("■")) {
                            $count += 1;
                        }
                        if ($j > 0 && $b[$i][$j - 1] === ("■")) {
                            $count += 1;
                        }
                        if ($j < 4 && $b[$i][$j + 1] === ("■")) {
                            $count += 1;
                        }
                        if ($i < 4 && $j > 0 && $b[$i + 1][$j - 1] === ("■")) {
                            $count += 1;
                        }
                        if ($i < 4 && $b[$i + 1][$j] === ("■")) {
                            $count += 1;
                        }
                        if ($i < 4 && $j < 4 && $b[$i + 1][$j + 1] === ("■")) {
                            $count += 1;
                        }

                        if ($count >= 3) {
                            $bb[$i][$j] = "■";
                        } else {
                            $bb[$i][$j] = "□";
                        }
                    }
                    if ($b[$i][$j] === ("■")) {
                        // 生存・過疎・過密の場合
                        $count = 0;

                        if ($i > 0 && $b[$i - 1][$j] === ("■")) {
                            $count += 1;
                        }
                        if ($j > 0 && $b[$i][$j - 1] === ("■")) {
                            $count += 1;
                        }
                        if ($j < 4 && $b[$i][$j + 1] === ("■")) {
                            $count += 1;
                        }
                        if ($i < 4 && $b[$i + 1][$j] === ("■")) {
                            $count += 1;
                        }

                        if ($count == 2) {
                            $bb[$i][$j] = $b[$i][$j];
                        } else {
                            $bb[$i][$j] = "□";
                        }
                    }
                }
            }
            $b = $bb;

            // 出力
            echo($times . "==========" . PHP_EOL);
            for ($i = 0; $i < 5; $i++) {
                $line = "";
                for ($j = 0; $j < 5; $j++) {
                    $line = $line . $b[$i][$j];
                }
                echo $line . PHP_EOL;
            }
        }
    }
}
