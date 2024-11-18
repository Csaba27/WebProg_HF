<?php
include "mysql_connect.php";

$con->query("TRUNCATE TABLE hallgatok");

function insertStudent(string $nev, string $szak, float $atlag)
{
    global $con;
    $sql = "INSERT INTO hallgatok (nev, szak, atlag) VALUES (?, ?, ?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('ssd', $nev, $szak, $atlag);

    if ($stmt->execute() === true) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . ", " . $con->error;
    }
    $stmt->close();
    echo "<br>";
}

$studentsData = array(
    array('John Doe', 'Informatika', 5.2),
    array('Alice Smith', 'Műszaki Informatika', 7.9),
    array('Bob Johnson', 'Gazdaságinformatika', 8.8),
    array('Eva Wilson', 'Matematika', 9.5),
    array('Mike Brown', 'Fizika', 5.0),
    array('Sarah Davis', 'Kémia', 3.7),
    array('David Lee', 'Biológia', 8.1),
    array('Linda Martinez', 'Informatika', 8.8),
    array('Tom Miller', 'Műszaki Informatika', 5.3),
    array('Karen Wilson', 'Gazdaságinformatika', 6.5)
);

foreach ($studentsData as $student) {
    insertStudent(...$student);
}
$con->close();