<?php

$szam = intval($_COOKIE['szam'] ?? '');

if ($szam <= 0 || $szam > 10) {
    $szam = mt_rand(1, 10);
    setcookie('szam', $szam, time() + 3600);
}

if (isset($_POST['elkuldott'])) {
    $talalgatas = $_POST['talalgatas'] ?? '';

    if (is_numeric($talalgatas)) {
        if ($szam > $talalgatas) {
            echo 'Szám nagyobb';
        } else if ($szam < $talalgatas) {
            echo 'Szám kisebb';
        } else if ($szam == $talalgatas) {
            setcookie('szam', '', time() - 3600);
            echo 'Szám egyenlő';
        }
    } else {
        echo '<h4 style="color: red;">Nem adtál megfelelő számot!</h4>';
    }

    echo '<br>';
}

?>

<form method="POST" action="">
    <input type="hidden" name="elkuldott" value="true">
    Melyik számra gondoltam 1 és 10 között?
    <label>
        <input name="talalgatas" type="text">
    </label>
    <br>
    <br>
    <input type="submit" value="Elküld">
</form>

