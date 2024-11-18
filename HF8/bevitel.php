<?php
session_start();
include "mysql_connect.php";

if (!($_SESSION['bejelentkezve'] ?? false)) {
    header('Location: bejelentkezes.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['hozzaad'])) {
    $nev = trim($_POST['nev'] ?? '');
    $szak = trim($_POST['szak'] ?? '');
    $atlag = floatval($_POST['atlag'] ?? 0.0);

    $sql = "INSERT INTO hallgatok (nev, szak, atlag) VALUES (?, ?, ?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('ssd', $nev, $szak, $atlag);

    if ($stmt->execute() === true) {
        echo '<a href="listazas.php">Listázás</a> | <a href="bevitel.php">Bevitel</a>';
    } else {
        echo "Hiba a bevitel során: " . $con->error;
    }
    $stmt->close();
    $con->close();
    die;
}
$con->close();
?>
<a href="listazas.php">Listázás</a>

<h1>Hallgató hozzáadas</h1>
<form method="post">
    <input type="hidden" name="hozzaad" value="1">
    <table>
        <tr>
            <td><label for="nev">Név:</label></td>
            <td><input type="text" id="nev" name="nev" value=""></td>
        </tr>
        <tr>
            <td><label for="szak">Szak:</label></td>
            <td><input type="text" id="szak" name="szak" value=""></td>
        </tr>
        <tr>
            <td><label for="atlag">Átlag:</label></td>
            <td><input type="number" id="atlag" name="atlag" value="0.0" step="0.1"></td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center;">
                <input type="submit" value="Hozzáad">
            </td>
        </tr>
    </table>
</form>
