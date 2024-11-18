<?php
session_start();
include "mysql_connect.php";

$bejelentkezve = $_SESSION['bejelentkezve'] ?? false;
$sql = "SELECT * FROM hallgatok";
$res = $con->query($sql);

$i = 0;
if ($bejelentkezve) {
    echo '<a href="bevitel.php">Új hallgató</a>';
} else {
    echo '<a href="bejelentkezes.php">Bejelentkezés</a>';
}
echo '<h1>Hallgatók listázása</h1>';
echo '<table border="1">';
while ($row = $res->fetch_assoc()) {
    $i++;

    echo '<tr>';
    echo '<td>' . $i . '</td>';
    echo '<td>' . $row['nev'] . '</td>';
    echo '<td>' . $row['szak'] . '</td>';
    echo '<td>' . $row['nev'] . '</td>';
    if ($bejelentkezve) {
        echo '<td><a href="szerkesztes.php?id=' . $row['id'] . '">Update</a></td>';
        echo '<td><a href="torles.php?id=' . $row['id'] . '">Delete</a></td>';
    }
    echo '</tr>';
}

echo '</table>';
$con->close();
