<?php
$honap = "julius";

$tavasz = ['marcius', 'aprilis', 'majus', 3, 4, 5, '03', '06', '05', 'march', 'april', 'may'];
$nyar = ['junius', 'julius', 'augusztus', 6, 7, 8, '06', '07', '08', 'june', 'july', 'august'];
$osz = ['szemptember', 'oktober', 'november', 9, 10, 11, '09', 'september', 'october'];
$tel = ['december', 'januar', 'februar', 12, 1, 2, 'january', 'february'];

$honap = strval($honap);
$honap = strtolower($honap);

echo "Megadott hónap: " . $honap;
echo '<br>' . PHP_EOL;

if (in_array($honap, $tavasz)) {
    echo 'Tavasz';
} else if (in_array($honap, $nyar)) {
    echo 'Nyár';
} else if (in_array($honap, $osz)) {
    echo 'Ősz';
} else if (in_array($honap, $tel)) {
    echo 'Tél';
} else {
    echo 'Érvénytelen hónap!';
}

echo '<br>Switch: ' . PHP_EOL;

switch ($honap) {
    case 'marcius':
    case 'aprilis':
    case 'majus':
    case '3':
    case '4':
    case '5':
    case '03':
    case '04':
    case '05':
    case 'march':
    case 'april':
    case 'may':
        echo 'Tavasz';
        break;
    case 'junius':
    case 'julius':
    case 'augusztus':
    case '6':
    case '7':
    case '8':
    case '06':
    case '07':
    case '08':
    case 'june':
    case 'july':
    case 'august':
        echo 'Nyár';
        break;
    case 'szemptember':
    case 'oktober':
    case 'november':
    case '9':
    case '10':
    case '11':
    case '09':
    case 'september':
    case 'october':
        echo 'Ősz';
        break;
    case 'december':
    case 'januar':
    case 'februar':
    case '12':
    case '1':
    case '2':
    case '01':
    case '02':
    case 'january':
    case 'february':
        echo 'Tél';
        break;
    default:
        echo 'Érvénytelen hónap';
        break;
}