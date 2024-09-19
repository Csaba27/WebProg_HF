<?php

$tomb = [5, '5', '05', 12.3, '16.7', 'five', 'true', 0xDECAFBAD, '10e200'];

foreach ($tomb as $ertek) {
    echo gettype($ertek) . PHP_EOL;
    if (is_numeric($ertek)) {
        echo "Igen" . PHP_EOL;
    } else {
        echo "Nem" . PHP_EOL;
    }
}