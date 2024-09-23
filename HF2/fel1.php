<?php

$color = "#03a9f4";

$fn = function(int $n) use ($color) {
    echo '<h1>Szorzótábla: ' . $n . '</h1>';
    echo '<table border="1">';
    for ($i = 1; $i <= $n; $i++) {
        echo '<tr>';
        for ($j = 1; $j <= $n; $j++) {
            if ($i == $j) {
                echo '<td style="background: ' . $color . '">' . ($i * $j) . '</td>';
            } else {
                echo '<td>' . ($i * $j) . '</td>';
            }
        }
        echo '</tr>';
    }

    echo '</table>';
};

$fn(10);
