<?php

$lista = [
    ["nev" => "Kenyer", "mennyiseg" => 2, "egysegar" => 8.5],
    ["nev" => "Viz", "mennyiseg" => 1, "egysegar" => 2.5],
];

function hozzaad($nev, $mennyiseg, $ar)
{
    global $lista;
    $termek = [
        'nev' => $nev,
        'mennyiseg' => $mennyiseg,
        'egysegar' => $ar
    ];

    $lista[] = $termek;
    return true;
}

function eltavolit($nev)
{
    global $lista;
    foreach ($lista as $kulcs => $termek) {
        if ($termek['nev'] === $nev) {
            unset($lista[$kulcs]);
            return true;
        }
    }
    return false;
}

function kiiarat()
{
    global $lista;
    echo '<h1>Kosár tartalma: </h1>';
    foreach ($lista as $kulcs => $termek) {
        printf("#%s Termek: %s, Mennyiség: %d, Egységár: %.2f<hr>\n",
            $kulcs + 1,
            $termek['nev'],
            $termek['mennyiseg'],
            $termek['egysegar']);
    }
}

function osszkoltseg()
{
    global $lista;
    $osszkoltseg = 0;

    foreach ($lista as $kulcs => $termek) {
       $osszkoltseg += $termek['mennyiseg'] * $termek['egysegar'];
    }

    return $osszkoltseg;
}

hozzaad('Felvagott', 3, 15.20);
kiiarat();
echo '<b>Összköltség: </b>' . osszkoltseg() . '<br>';
eltavolit('Kenyer');
kiiarat();