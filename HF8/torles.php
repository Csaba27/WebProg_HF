<?php
session_start();
include "mysql_connect.php";

if (!($_SESSION['bejelentkezve'] ?? false)) {
    header('Location: bejelentkezes.php');
}

$id = intval($_GET['id'] ?? 0);

$sql = "SELECT * FROM hallgatok WHERE id = " . $id;
$res = $con->query($sql);

if ($res->num_rows > 0) {
    $hallgato = $res->fetch_assoc();

    $sql = "DELETE FROM hallgatok WHERE id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('i', $id);
    if ($stmt->execute()) {
        header('Location: listazas.php');
    } else {
        echo 'Törlés nem sikerült: ' . $sql;
    }
    $stmt->close();

} else {
    echo 'Hallgató nem létezik!';
}

$con->close();