<?php

$b = [];
for ($i = 0; $i < 5; $i++) {
    for ($j = 0; $j < 5; $j++) {
        $b[$i][$j] = "□";
    }
}

for ($i = 0; $i < 5; $i++) {
    $line = "";
    for ($j = 0; $j < 5; $j++) {
        $line = $line . $b[$i][$j];
    }
    echo($line . PHP_EOL);
}

