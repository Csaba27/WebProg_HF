<?php
$seconds = '3601';

if (is_int($seconds) || ctype_digit($seconds)) {
    $hours = floor($seconds / 3600);
    echo "<b>Másodperc órában:</b> {$hours}";
} else {
    echo "<b>Hiba:</b> Nem egész számot adtál meg!";
}