<?php

$napok = array(
    "HU" => array("H", "K", "Sze", "Cs", "P", "Szo", "V"),
    "EN" => array("M", "Tu", "W", "Th", "F", "Sa", "Su"),
    "DE" => array("Mo", "Di", "Mi", "Do", "F", "Sa", "So"),
);

foreach ($napok as $nyelv => $napLista) {
    echo $nyelv . ': ';
    $i = 0;
    $napokSzama = count($napLista);

    foreach ($napLista as $nap) {
        $i++;

        if ($i % 2 == 0) {
            echo '<b>' . $nap . '</b>';
        } else {
            echo $nap;
        }
        if ($i != $napokSzama) {
            echo ', ';
        }
    }
    echo '<br>' . PHP_EOL;
}