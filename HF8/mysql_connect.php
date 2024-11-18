<?php
$server = "localhost";
$username = "root";
$password = "";
$db_name = "egyetem";
$con = new mysqli($server, $username, $password, $db_name);

if ($con->connect_errno) {
    die("Connection failed: " . $con->connect_error);
}

/*
$sql = "CREATE DATABASE IF NOT EXISTS egyetem";
if ($con->query($sql) === true) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . $con->error;
}
echo "<br>";

$con->select_db("egyetem");

$sql = "CREATE TABLE IF NOT EXISTS hallgatok (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nev VARCHAR(255) NOT NULL,
    szak VARCHAR(255) NOT NULL,
    atlag double NOT NULL
);";

if ($con->query($sql) === true) {
    echo "Table created successfully";
} else {
    echo "Error creating table: " . $con->error;
}
echo "<br>";

$con->close();
*/