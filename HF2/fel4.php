<?php
$szinek = array('A' => 'Kek', 'B' => 'Zold', 'c' => 'Piros');
$tipus = 'kisbetus';
function atalakit(array &$tomb, $tipus) {
    foreach ($tomb as &$ertek) {
        if ($tipus === 'kisbetus') {
            $ertek = strtolower($ertek);
        } else if ($ertek === 'nagybetus') {
            $ertek = strtoupper($ertek);
        }
    }
    return $tomb;
}

print_r(atalakit($szinek, $tipus));

echo '<br>' . PHP_EOL;

print_r(array_map(function($ertek) use ($tipus) {
    if ($tipus === 'kisbetus') {
       $ertek = strtolower($ertek);
    } else if ($ertek === 'nagybetus') {
        $ertek = strtoupper($ertek);
    }
    return $ertek;
}, $szinek));